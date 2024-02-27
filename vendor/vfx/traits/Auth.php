<?php

namespace vfx\traits;

trait Auth
{

    protected function checkUser(string $email, string $password, string $role = 'user'): bool
    {
        session_start();
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $auth = new \vfx\models\Auth();
        $auth = $auth->select()->where('email', '=', $email)->andWhere('role', '=', $role)->get('fetch');

        if(!empty($auth) && password_verify($password, $auth['password'])) {
            $_SESSION['auth_status'] = true;
            $_SESSION['user_id'] = (int)$auth['id'];
            return true;
        }

        return false;
    }

    protected function statusAuth(string $role = 'user'): void
    {
        session_start();
        if(empty($_SESSION['user_id']) && !isset($_SESSION['auth_status'])) {
            header("Location: /");
            die();
        }
    }

}