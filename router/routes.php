<?php

use App\Services\Router;
use App\Controllers\Auth;
use App\Controllers\User;
use App\Controllers\Post;

Router::addPage('/', 'home');
Router::addPage('/about', 'about');
Router::addPage('/support', 'support');
Router::addPage('/login', 'login');
Router::addPage('/registr', 'registr');
Router::addPage('/create', 'create');


Router::action('/user/auth', Auth::class, 'auth');
Router::action('/user/login', Auth::class, 'login');
Router::action('/user', User::class, 'user');
Router::action('/posts', User::class, 'posts');
Router::action('/add', User::class, 'add');
Router::action('/update/add', Post::class, 'add');
if (!empty($_GET)){
    Router::action('/post?id=' . $_GET['id'], User::class, 'post');
    Router::action('/update?id=' . $_GET['id'], User::class, 'update');
}
Router::action('/user/exit', User::class, 'exit');

Router::enable();
