<?php

session_start();

use App\Services\Page;

Page::part('navbar');
?>

<div class="container">
        <h1><?=$title?></h1>
        <h4 class="posttitle"><?=$smtext?></h4>
    <div class="post">
        <img class="postimg" src="/assets/post/<?=$img?>">
        <p><?=$text?></p>
    </div>
    <div class="author">
        <p><?=$author?></p>
        <p><?=$time?></p>
    </div>
    <div>
        <a class="back" href="posts">All posts</a>
        <?php
        if ($author === $_SESSION['name']) {
            $id = $_GET['id'];
            var_dump($id);
            echo "<a class='refactor' href='update/?id=$id'>Refactor post</a>";
            echo "<pre>";
            var_dump($_GET);
            var_dump($_SESSION);
        }
        ?>
    </div>
</div>
