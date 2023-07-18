<?php
use App\Services\Page;

Page::part('header');
?>

<form action="/user/login" method="post">
    <label for="email">Print your email</label>
    <input type="email" name="email" id="email">
    <label for="password">Print your password</label>
    <input type="password" name="password" id="password">
    <button type="submit">Войти в Айти</button>
</form>
