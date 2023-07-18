<?php

namespace App\Controllers;

use App\Services\Router;
use App\DB\DB;
use App\Controllers\SessionShell;
use App\Services\Mail;

class Auth 
{
    public function auth(){
        $userName = $_POST['firstName'] . ' ' . $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $db = new DB();
        $check = $db->query("SELECT * FROM `users` WHERE `email` = :email", ['email' => $email]);
        if(!empty($check)) {
            $sess = new SessionShell();
            $sess->set('msg', 'Пользователь с такой почтой уже есть, введите другую почту');
            header('Location: /registr');
        } else {
            if(!empty($_FILES['file']['name'])) {
                $file = $_FILES['file'];
                $file['name'] = $email;
                $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/avatar/' . $file['name'];
                move_uploaded_file($file['tmp_name'], $path);
                $avatar = $email;
            } else {
                $avatar = 'NULL.png';
            }
            $db->query("INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`) VALUES
            (NULL, :name, :email, :password, :avatar)", ['name' => $userName, 'email' => $email, 'password' => $password, 'avatar' => $avatar]);
            $settings = require_once 'settings.php';
            $attachments = './assets/avatar/' . $avatar;
            $body = require_once 'views/components/mail.php';
            header('Location: /login');
            Mail::send_mail($settings['mail_settings'], $email, 'Уведомление о регистрации', $body, $attachments);
        }
    }

    public function login(){
        if (!empty($_POST['email']) && !empty($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $db = new DB();
            $checkUser = $db->query("SELECT * FROM users WHERE email = :email AND password = :password",
                ['email' => $email, 'password' => $password]);
            if ($checkUser){
                $checkUser = $checkUser[0];
                $sess = new SessionShell();
                $sess->set('id', $checkUser['id']);
                $sess->set('name', $checkUser['name']);
                $sess->getAll();
                header('Location: /user');
            } else{
                header('Location: /login');
            }
        } else {
            header('Location: /login');
        }
    }
}