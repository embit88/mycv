<?php

namespace app\controllers\admin;

use app\models\Work;
use app\models\WorkDescription;
use vfx\App;
use vfx\Router;

class WorkController extends BaseController
{

    public function indexAction(): void
    {
        $lang_id = App::$app->getProperty('language_id') ?? 1;

        $works = new Work();
        $works = $works->select()->leftjoin('work_descriptions', 'works.id', '=', 'work_descriptions.work_id')->where('work_descriptions.language_id', '=', $lang_id)->get();

        $this->setData(['works' => $works]);
    }

    public function editAction(): void
    {
        $this->view = 'form';

        $works = new Work();
        $works = $works->select()->where('id', '=', Router::getRoute()['id'])->get('fetch');

        if(empty($works)) {
            throw new \Exception('Страница не найдена', 404);
        }

        $work_descriptions = new WorkDescription();
        $work_descriptions = $work_descriptions->select()->where('work_id', '=', Router::getRoute()['id'])->get();
        $work_descriptions = toArrayKey($work_descriptions, 'language_id');

        $works = array_replace_recursive($works, $work_descriptions);

        if(!empty($_POST)) {
            $date_start = $_POST['date_start'] ?? null;
            $date_end = $_POST['date_end'] ?? null;
            $site_url = $_POST['site_url'] ?? null;

            $work_edit = new Work();
            $work_edit->update(['date_start' => $date_start, 'date_end' => $date_end, 'site_url' => $site_url])->where('id', '=', Router::getRoute()['id'])->execute();

            if(isset($_POST['description']) & count($_POST['description']) > 0) {
                foreach ($_POST['description'] as $lang_id => $description) {
                    $work_descriptions_edit = new WorkDescription();
                    $work_descriptions_edit->update(['content' => $description['content'], 'name' => $description['name']])->where('work_id', '=', Router::getRoute()['id'])->andWhere('language_id', '=', $lang_id)->execute();
                }
            }
            header("Location: ".$_SERVER['REQUEST_URI']);
            die();
        }

        $this->setData(['works' => $works]);
    }

    public function addAction()
    {
        $this->view = 'form';

        if(!empty($_POST)) {

            $date_start = $_POST['date_start'] ?? null;
            $date_end = $_POST['date_end'] ?? null;
            $site_url = $_POST['site_url'] ?? null;

            if(!empty($date_start)) {
                $work_edit = new Work();
                $work_edit->insert(['date_start' => $date_start, 'date_end' => $date_end, 'site_url' => $site_url])->execute();
                $last_work_id = $work_edit->lastInsertId();

                if(!empty($last_work_id) && isset($_POST['description']) & count($_POST['description']) > 0) {
                    foreach ($_POST['description'] as $lang_id => $description) {
                        $work_descriptions_edit = new WorkDescription();
                        $work_descriptions_edit->insert(['work_id' => $last_work_id, 'language_id' => $lang_id, 'content' => $description['content'], 'name' => $description['name']])->execute();
                    }
                }
            }

            $url_redirect = Router::getRouteName('admin.works.index', 'url');
            header("Location: {$url_redirect}");
            die();
        }
    }

}