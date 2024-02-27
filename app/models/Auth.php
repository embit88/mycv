<?php

namespace app\models;

class Auth extends BaseModel
{
    public string $table = 'users';

    public array $attributes = [
        'email' => '',
        'password' => '',
    ];

    public array $rules = [
        'required' => ['email', 'password'],
        'string' => ['email', 'password'],
        'email' => ['email'],
    ];

}