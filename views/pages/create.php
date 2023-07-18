<?php
session_start();
use App\Services\Page;
//Page::part('header');
Page::part('navbar');
$date = date("d.m.y")
?>
<pre>
    <?php
//    var_dump($_SESSION);
//    var_dump($date);
//    var_dump($_POST);
//    var_dump($_FILES);
    ?>
</pre>
<div class="container">
    <form action="/add" method="post" enctype="multipart/form-data">
        <label for="title">Wrtie post title</label>
        <input type="text" id="title" name="title">
        <label for="smtext">Write small text</label>
        <input type="text" id="smtext" name="smtext">
        <label for="text">Write text</label>
        <input type="text" id="text" name="text">
        <input type="file" name="file">
        <input type="hidden" value='<?=$date?>' name="date" >
        <input type="hidden" value='<?=$_SESSION['name']?>' name="author">
        <button type="submit">Написать пост!</button>
    </form>
</div>
