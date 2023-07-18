<?php

use App\Controllers\SessionShell;
use App\Services\Page;

Page::part('navbar');
?>

<div class="container">
    <div class="userinfo">
        <div class="userabout">
            <h1>Your name: <?=$name?></h1>
            <h1>Your password: <?=$password?></h1>
            <h1>Your email: <?=$email?></h1>
            <a href="posts">Read posts</a>
        </div>
        <img class="avatar" src="/assets/avatar/<?=$img?>">
    </div>
    <a class="create" href="/create">Write post</a>
    <h1>Yours posts:</h1>
</div>

