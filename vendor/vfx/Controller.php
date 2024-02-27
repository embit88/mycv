<?php

namespace vfx;

abstract class Controller
{

    public array $data = [];
    public array $meta = [];
    public string $view = '';
    public string $theme = '';
    public object $model;

    public function __construct(public array $route = [])
    {

    }

    public function getModel(): void
    {
        $model = 'app\models\\' . $this->route['admin_prefix'] . $this->route['controller'];
        if(class_exists($model)) {
            $this->model = new $model();
        }
    }

    public function getView(): void
    {
        $this->view = !empty($this->view) ? $this->view : $this->route['action'];
        $view_object = new View($this->route, $this->view, $this->theme, $this->meta);
        $view_object->render($this->data);
    }

    public function setData(array $data): void
    {
        foreach ($data as $key => $value)
        $this->data[$key] = $value;
    }

    public function setMeta(string $title = '', string $description = '', string $keywords = ''): void
    {
        $this->meta = [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ];
    }

}