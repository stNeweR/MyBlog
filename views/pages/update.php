<?php
session_start();

use App\Services\Page;

Page::part('navbar');
?>


<form action="update/add" method="post" enctype="multipart/form-data">
    <input name="id" type="hidden" value="<?=$id?>">
    <label for="title">Write new title</label>
    <input class="title" value="<?=$db['title']?>" name="title" id="title">
    <label for="small text">Write small text</label>
    <textarea class="smtext" name="small text" id="small text"><?=$db['small text']?></textarea>
    <label for="text">Write new text</label>
    <textarea class="text" name="text" id="text"><?=$db['text']?></textarea>
    <input type="file">
    <button type="submit">Update post</button>
</form>

