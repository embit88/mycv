<?php

namespace app\controllers\admin;

use app\models\Contact;
use vfx\Router;

class ContactController extends BaseController
{

    public function indexAction(): void
    {
        $contacts = new Contact();
        $contacts = $contacts->select()->where('id', '=', 1)->get('fetch');

        if(!empty($_POST)) {
            $phone = $_POST['phone'] ?? null;
            $phone_other = $_POST['phone_other'] ?? null;
            $email = $_POST['email'] ?? null;
            $telegram = $_POST['telegram'] ?? null;
            $github = $_POST['github'] ?? null;

            $contact_edit = new Contact();
            $contact_edit->update(['phone' => $phone, 'phone_other' => $phone_other, 'email' => $email, 'telegram' => $telegram, 'github' => $github])->where('id', '=', 1)->execute();

            $url_redirect = Router::getRouteName('admin.contacts.index', 'url');
            header("Location: {$url_redirect}");
            die();
        }

        $this->setData(['contacts' => $contacts]);
    }

}