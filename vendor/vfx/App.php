<?php

namespace vfx;

class App
{

    public static object $app;
    public static object $request;

    public function __construct()
    {
        self::$request = Request::getInstance();
        new ErrorHandler();
        self::$app = Config::getInstance();
        Config::startConfig(self::$app);
        MultiLanguage::getInstance()->start();
        $request_url = trim(urldecode(self::$request->request_uri()), '/');
        Router::dispatch($request_url);
    }

}