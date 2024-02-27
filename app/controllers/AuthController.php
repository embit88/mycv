<?php

namespace app\controllers;

use vfx\traits\Auth;

class AuthController extends BaseController
{

    use Auth;
    public function indexAction(): void
    {
        $admin_url = '/' . ADMIN_URL;

        if(!empty($_POST['password']) && !empty(['email'])) {
            $this->model->load($_POST);

            if($this->checkUser($this->model->attributes['email'], $this->model->attributes['password'], 'admin')) {
                header("Location: {$admin_url}/dashboard");
                die();
            }

        }

        if(!empty($_SESSION['user_id']) && empty($_POST)) {
            header("Location: {$admin_url}/dashboard");
            die();
        }

        $this->setMeta(lang('title_login'), lang('title_login'));
    }



}