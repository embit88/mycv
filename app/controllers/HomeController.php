<?php

namespace app\controllers;

use app\models\Contact;
use app\models\Information;
use app\models\Project;
use app\models\Skill;
use app\models\Work;
use vfx\App;
use vfx\Cache;

class HomeController extends BaseController
{
    public function indexAction(): void
    {
        $lang_id = App::$app->getProperty('language_id');

        $informations = Cache::get("informations_{$lang_id}");

        if(empty($informations)) {
            $informations = new Information();
            $informations = $informations->select()->leftjoin('information_descriptions', 'informations.id', '=', 'information_descriptions.information_id')->where('information_descriptions.language_id', '=', $lang_id)->get('fetch');
            Cache::set("informations_{$lang_id}", $informations);
        }

        $skills = Cache::get("skills_{$lang_id}");

        if(empty($skills)) {
            $skills = new Skill();
            $skills = $skills->select()->leftjoin('skill_descriptions', 'skills.id', '=', 'skill_descriptions.skill_id')->where('skill_descriptions.language_id', '=', $lang_id)->get('fetch');
            Cache::set("skills_{$lang_id}", $skills);
        }

        $works = Cache::get("works_{$lang_id}");

        if(empty($works)) {
            $works = new Work();
            $works = $works->select()->leftjoin('work_descriptions', 'works.id', '=', 'work_descriptions.work_id')->where('work_descriptions.language_id', '=', $lang_id)->get();
            Cache::set("works_{$lang_id}", $works);
        }

        $projects = Cache::get("projects_{$lang_id}");

        if(empty($projects)) {
            $projects = new Project();
            $projects = $projects->select()->leftjoin('project_descriptions', 'projects.id', '=', 'project_descriptions.project_id')->where('project_descriptions.language_id', '=', $lang_id)->order('sort_order ASC')->limit(PAGINATION_COUNT)->get();
            Cache::set("projects_{$lang_id}", $projects);
        }

        $contacts = Cache::get("contacts_{$lang_id}");

        if(empty($contacts)) {
            $contacts = new Contact();
            $contacts = $contacts->select()->get('fetch');
            Cache::set("contacts_{$lang_id}", $contacts);
        }

        $this->setMeta(lang('meta_title_home'), lang('meta_title_description'));
        $this->setData(['informations' => $informations, 'skills' => $skills, 'works' => $works, 'projects' => $projects, 'contacts' => $contacts]);
    }

}