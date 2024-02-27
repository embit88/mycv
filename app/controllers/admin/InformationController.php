<?php

namespace app\controllers\admin;

use app\models\Information;
use app\models\InformationDescription;
use vfx\Router;

class InformationController extends BaseController
{

    public function indexAction(): void
    {
        $information = new Information();
        $information = $information->select()->where('id', '=', 1)->get('fetch');

        $information_descriptions = new InformationDescription();
        $information_descriptions = $information_descriptions->select()->where('information_id', '=', 1)->get();
        $information_descriptions = toArrayKey($information_descriptions, 'language_id');

        $information = array_replace_recursive($information, $information_descriptions);

        if(!empty($_POST)) {
            if(!empty($_POST['image'])) {
                $information_edit = new Information();
                $information_edit->update(['image' => $_POST['image']])->where('id', '=', 1)->execute();
            }

            if(isset($_POST['description']) & count($_POST['description']) > 0) {
                foreach ($_POST['description'] as $lang_id => $description) {
                    $information_descriptions_edit = new InformationDescription();
                    $information_descriptions_edit->update(['content' => $description['content']])->where('information_id', '=', 1)->andWhere('language_id', '=', $lang_id)->execute();
                }
            }
            $url_redirect = Router::getRouteName('admin.information.index', 'url');
            header("Location: {$url_redirect}");
            die();
        }

        $this->setData(['information' => $information]);
    }

}