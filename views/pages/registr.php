<?php
session_start();
use App\Services\Page;
Page::part('header');
//var_dump($_SESSION);
?>
<div class="container" >
    <?php
    if (!empty($_SESSION['msg'])) {
        echo "<h1 class='msg new'>" . $_SESSION['msg'] ."</h1>";
    }
    ?>
    <form action="/user/auth" method="post" enctype="multipart/form-data">
        <label for="email">Print your email</label>
        <input type="text" name="email" id="email">
        <label for="password">Print your password</label>
        <input type="password" name="password" id="password">
        <label for="firstName">Print your First name</label>
        <input type="text" name="firstName" id="firstName">
        <label for="lastName">Print your Last name</label>
        <input type="text" name="lastName" id="lastName">
        <input class="file" type="file" name="file">
        <button type="submit">Зарегестрироваться</button>
    </form>
</div>
