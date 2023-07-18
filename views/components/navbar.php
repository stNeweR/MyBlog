<?php
session_start();

use App\Services\Page;
//use App\Controllers\SessionShell;
Page::part('header');

?>

<header>
    <div>
        <a href="/">Главная</a>
        <a href="about">О нас</a>
        <a href="support">Support</a>
    </div>
    <?php
//    var_dump($_SESSION);
    if (isset($_SESSION['name'])){
        echo "<div class='user'>";
        echo "<a class='posturl' href='posts'>Read pls</a>";
        echo '<div class="userexit">';
        echo "<a class='username' href='user'>$_SESSION[name]</a>";
        echo "<a href='user/exit'>Exit account</a>";
        echo '</div>';
        echo "</div>";
    } else{
        ?>
        <div class="sign">
            <a href="login">Войти</a>
            <a href="registr">Регситрация</a>
        </div>
    <?php
    }
    ?>
</header>