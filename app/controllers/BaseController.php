<?php

namespace app\controllers;

use app\models\Category;
use vfx\App;
use vfx\Cache;
use vfx\Controller;
use vfx\Lang;
use vfx\Router;

abstract class BaseController extends Controller
{

    public function __construct()
    {
        parent::__construct(Router::getRoute());
        $lang_id = App::$app->getProperty('language_id');
        $categories = Cache::get("categories_{$lang_id}");

        if(empty($categories)) {
            $categories = new Category();
            $categories = $categories->select()->leftjoin('category_descriptions', 'categories.id', '=', 'category_descriptions.category_id')->where('category_descriptions.language_id', '=', App::$app->getProperty('language_id'))->order('sort_order ASC')->get();
            Cache::set("categories_{$lang_id}", $categories);
        }

        $words = Lang::getWords(App::$app->getProperty('locale'));

        $this->setData(['categories' => $categories, 'words' => $words]);
    }

}