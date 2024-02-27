<?php

namespace vfx;

use vfx\traits\Singleton;

class Request
{

    use Singleton;

    public array $request = [];

    private function __construct()
    {
        $this->request = $_SERVER;
    }

    public function request_uri(): string
    {
        return $this->request['REQUEST_URI'];
    }

    public function all(): array
    {
        return $this->request;
    }

    public function segment(int $count): string|null
    {
        $request_url = trim(urldecode($this->request_uri()), '/');
        $request_url = explode('/', $request_url);
        return $request_url[$count] ?? null;
    }

    public function site_url(): string
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        return  $protocol . $this->request['HTTP_HOST'];
    }

}