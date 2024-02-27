<?php

namespace app\controllers;

use app\models\Contact;
use app\models\Information;
use app\models\Project;
use app\models\Skill;
use vfx\App;
use vfx\Cache;
use vfx\Router;

class ProjectController extends BaseController
{
    public function indexAction(): void
    {

    }

    public function viewAction(): void
    {
        $lang_id = App::$app->getProperty('language_id');

        if(!empty(Router::getRoute()['slug'])) {
            $project = new Project();
            $project = $project->select()->leftjoin('project_descriptions', 'projects.id', '=', 'project_descriptions.project_id')->where('project_descriptions.language_id', '=', $lang_id)->andWhere('projects.slug', '=', Router::getRoute()['slug'])->get('fetch');

            if(empty($project)) {
                throw new \Exception('Страница не найдена', 404);
            }

            $this->setMeta(SITE_NAME . ' | ' . $project['name'], SITE_NAME . ' | ' . $project['name']);
            $this->setData(['project' => $project]);
        }
    }

    public function apiAction(): void
    {
        $this->view = 'json';

        $lang_id = App::$app->getProperty('language_id');

        $page = 1;
        if(!empty($_POST['page'])) {
            $page = (int)$_POST['page'];
        }

        $offset = PAGINATION_COUNT * $page;

        $projects = new Project();
        $projects = $projects->select()->leftjoin('project_descriptions', 'projects.id', '=', 'project_descriptions.project_id')->where('project_descriptions.language_id', '=', $lang_id)->order('sort_order ASC')->limit(PAGINATION_COUNT)->offset($offset)->get();

        echo json_encode($projects);
    }

}