<?php

namespace vfx;

class View
{

    public string $content = '';
    public array $data = [];

    public function __construct(public array $route, public string $view = '', public string $theme = '', public array $meta = [])
    {

    }

    public function render(array $data): void
    {
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $theme_path = !empty($this->theme) ? $this->theme : DEFAULT_THEME;
        $admin_prefix = ADMIN_URL . '/';
        $this->data = $data;

        if($this->view != 'json') {
            $view_file = strtolower(VIEW_PATH . "/{$theme_path}/{$this->route['controller']}/{$this->view}.php");

            if(rtrim($prefix, '/') === ADMIN_URL) {
                $admin_prefix = str_replace('-', '_', $admin_prefix);
                $view_file = strtolower(VIEW_PATH . "/{$admin_prefix}{$this->route['controller']}/{$this->view}.php");
            }

            if (file_exists($view_file)) {
                ob_start();
                require_once $view_file;
                $this->content = ob_get_clean();
            } else {
                throw new \Exception("Не найден вид {$view_file}", 500);
            }

            $theme_file = VIEW_PATH . "/{$theme_path}/main.php";
            if (file_exists($theme_file)) {
                require_once $theme_file;
            } else {
                throw new \Exception("Не найдена тема {$theme_file}", 500);
            }
        }
    }

    public function getMeta(string $type): string
    {
        return isset($this->meta[$type]) ? htmlspecialchars($this->meta[$type]) : SITE_NAME;
    }

}