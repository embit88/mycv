<?php

namespace app\controllers\admin;

use app\models\Skill;
use app\models\SkillDescription;
use vfx\Router;

class SkillController extends BaseController
{

    public function indexAction(): void
    {
        $skills = new Skill();
        $skills = $skills->select()->where('id', '=', 1)->get('fetch');

        $skill_descriptions = new SkillDescription();
        $skill_descriptions = $skill_descriptions->select()->where('skill_id', '=', 1)->get();
        $skill_descriptions = toArrayKey($skill_descriptions, 'language_id');

        $skills = array_replace_recursive($skills, $skill_descriptions);

        if(!empty($_POST)) {
            if(!empty($_POST['date_start'])) {
                $skill_edit = new Skill();
                $skill_edit->update(['date_start' => $_POST['date_start']])->where('id', '=', 1)->execute();
            }

            if(isset($_POST['description']) & count($_POST['description']) > 0) {
                foreach ($_POST['description'] as $lang_id => $description) {
                    $skill_descriptions_edit = new SkillDescription();
                    $skill_descriptions_edit->update(['content_first' => $description['content_first'], 'content_second' => $description['content_second'], 'content_third' => $description['content_third']])->where('skill_id', '=', 1)->andWhere('language_id', '=', $lang_id)->execute();
                }
            }
            $url_redirect = Router::getRouteName('admin.skills.index', 'url');
            header("Location: {$url_redirect}");
            die();
        }

        $this->setData(['skills' => $skills]);
    }

}