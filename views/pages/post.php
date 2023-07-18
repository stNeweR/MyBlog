<?php

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
    <a class="back" href="posts">All posts</a>
</div>
