<?php

namespace app\controllers\admin;

use vfx\Controller;
use vfx\Router;
use vfx\traits\Auth;

abstract class BaseController extends Controller
{
    use Auth;

    public string $theme = 'admin';

    public function __construct()
    {
        parent::__construct(Router::getRoute());

        $this->statusAuth();
    }

}