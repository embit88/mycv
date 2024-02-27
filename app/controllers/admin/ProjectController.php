<?php

namespace app\controllers\admin;

use app\models\Project;
use app\models\ProjectDescription;
use vfx\App;
use vfx\Router;

class ProjectController extends BaseController
{

    public function indexAction(): void
    {
        $lang_id = App::$app->getProperty('language_id') ?? 1;

        $projects = new Project();
        $projects = $projects->select()->leftjoin('project_descriptions', 'projects.id', '=', 'project_descriptions.project_id')->where('project_descriptions.language_id', '=', $lang_id)->get();

        $this->setData(['projects' => $projects]);
    }

    public function editAction(): void
    {
        $this->view = 'form';

        $projects = new Project();
        $projects = $projects->select()->where('id', '=', Router::getRoute()['id'])->get('fetch');

        if(empty($projects)) {
            throw new \Exception('Страница не найдена', 404);
        }

        $project_descriptions = new ProjectDescription();
        $project_descriptions = $project_descriptions->select()->where('project_id', '=', Router::getRoute()['id'])->get();
        $project_descriptions = toArrayKey($project_descriptions, 'language_id');

        $projects = array_replace_recursive($projects, $project_descriptions);

        if(!empty($_POST)) {
            $image = $_POST['image'] ?? null;
            $slug = $_POST['slug'] ?? null;
            $site_url = $_POST['site_url'] ?? null;
            $sort_order = $_POST['sort_order'] ?? null;

            $project_edit = new Project();
            $project_edit->update(['image' => $image, 'slug' => $slug, 'site_url' => $site_url, 'sort_order' => $sort_order])->where('id', '=', Router::getRoute()['id'])->execute();

            if(isset($_POST['description']) & count($_POST['description']) > 0) {
                foreach ($_POST['description'] as $lang_id => $description) {
                    $project_descriptions_edit = new ProjectDescription();
                    $project_descriptions_edit->update(['short_content' => $description['short_content'], 'content' => $description['content'], 'name' => $description['name']])->where('project_id', '=',  Router::getRoute()['id'])->andWhere('language_id', '=', $lang_id)->execute();
                }
            }
            header("Location: ".$_SERVER['REQUEST_URI']);
            die();
        }

        $this->setData(['projects' => $projects]);
    }

    public function addAction()
    {
        $this->view = 'form';

        if(!empty($_POST)) {
            $image = $_POST['image'] ?? null;
            $slug = $_POST['slug'] ?? null;
            $site_url = $_POST['site_url'] ?? null;
            $sort_order = $_POST['sort_order'] ?? 0;

            if(!empty($slug)) {
                $project_edit = new Project();
                $project_edit->insert(['image' => $image, 'slug' => $slug, 'site_url' => $site_url, 'sort_order' => $sort_order])->execute();
                $last_project_id = $project_edit->lastInsertId();

                if(!empty($last_project_id) && isset($_POST['description']) & count($_POST['description']) > 0) {
                    foreach ($_POST['description'] as $lang_id => $description) {
                        $project_descriptions_edit = new ProjectDescription();
                        $project_descriptions_edit->insert(['project_id' => $last_project_id, 'language_id' => $lang_id, 'short_content' => $description['short_content'], 'content' => $description['content'], 'name' => $description['name']])->execute();
                    }
                }
            }

            $url_redirect = Router::getRouteName('admin.projects.index', 'url');
            header("Location: {$url_redirect}");
            die();
        }
    }

}