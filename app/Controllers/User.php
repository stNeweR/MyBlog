<?php

namespace App\Controllers;

use App\Controllers\SessionShell;
use App\DB\DB;
use App\Services\Page;
use App\Services\Mail;

class User
{
    private object $db;
    private object $sess;

    public function __construct(){
        $this->sess = new SessionShell();
        $this->db = new DB();
    }
    public function user(){
        $id = $this->sess->get('id');
        $db = $this->db->query("SELECT * FROM users WHERE `id` = '$id';");
        $db = $db[0];
        $name = $db['name'];
        $password = $db['password'];
        $email = $db['email'];
        $img = $db['avatar'];
        require_once 'views/pages/user.php';
        $posts = $this->db->query(" SELECT * FROM posts WHERE `author` = :author",  ['author' => $name]);
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $title = $post['title'];
                $smtext = $post['small text'];
                $author = $post['author'];
                $time = $post['time'];
                $id = $post['id'];
                require 'views/pages/posts.php';
            }
        } else {
            echo '<h1 class="msg">You not write posts :(</h1>';
        }
    }

    public function posts(){
        Page::part('navbar');
        $db = $this->db->getAll('posts');
        foreach ($db as $item) {
            $title = $item['title'];
            $smtext = $item['small text'];
            $author = $item['author'];
            $time = $item['time'];
            $id = $item['id'];
            require 'views/pages/posts.php';
        }
    }
    public function post(){
        $id = $_GET['id'];
        $db = $this->db->query("SELECT * FROM posts WHERE `id` = :id", ['id' => $id]);
        $db = $db[0];
        $title = $db['title'];
        $smtext = $db['small text'];
        $text = $db['text'];
        $img = $db['img'];
        $time = $db['time'];
        $author = $db['author'];
        require 'views/pages/post.php';
    }

    public function add() {
        $title = $_POST['title'];
        $smtext = $_POST['smtext'];
        $text = $_POST['text'];
        $date = $_POST['date'];
        $author = $_POST['author'];
        $file = $_FILES['file'];
        $file['name'] = $title;
        $name = $file['name'];
        $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/post/" . $name;
        $db = $this->db->query("INSERT INTO `posts` (`id`, `title`, `text`, `small text`, `img`, `author`, `time`
) VALUES (NULL, :title, :text, :smtext, :img, :author, :time)",
            ['title' => $title, 'text' => $text, 'smtext' => $smtext, 'img' => $name, 'author' => $author, 'time' => $date]);
        var_dump($_POST);
        move_uploaded_file($file['tmp_name'], $path);
        header("Location: /user");
    }

    public function update() {
        $id = $_GET['id'];
        $db = $this->db->query("SELECT * FROM `posts` WHERE `id` = :id", ['id' => $id]);
        $db = $db[0];
        require_once './views/pages/update.php';
    }

    public function exit() {
        var_dump($this->sess->getAll());
        $this->sess->destroy();
        var_dump($_SESSION);
        header("Location: /");
    }
}
