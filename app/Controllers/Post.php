<?php

namespace App\Controllers;

use App\DB\DB;
use App\Controllers\SessionShell;

class Post
{
    public function __construct(){
        $this->sess = new SessionShell();
        $this->db = new DB();
    }

    public function add()
    {
        echo '<pre>';
        $id = $_POST['id'];
        $title = $_POST['title'];
        $smtext = $_POST['small_text'];
        $text = $_POST['text'];
        $update = $this->db->query("UPDATE `posts` SET `title` = :title, 
        `small text` = :smtext, `text` = :text WHERE `id` = :id;",
        ['title' => $title, 'smtext' => $smtext, 'text' => $text, 'id' => $id]);
        header('Location: /user');
    }
}