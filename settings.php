<?php
session_start();
define('SITE_URL', 'http://php8/');

include 'functions.php';

//получаем запись по id
if(isset($_GET['id'])){
	$article_id = (int)$_GET['id'];
	$article = getArticle($article_id);
}

//Если существует id категории, то получаем все записи из этой категории
if(isset($_GET['cat_id'])){
    $cat_id = (int)$_GET['cat_id'];
    $articlesByCatId = getArticlesByCategory($cat_id);
}

if(isset($_GET['query'])){
    $query = strip_tags(htmlspecialchars(trim($_GET['query'])));
    $findedArticles = findArticles($query);
}

//Установка локали и даты
setlocale(LC_ALL, "russian");
//Час
$hour = strftime('%H');
$date = strftime('%d.%m.%Y %H ч %M мин %S сек');
/*Приветствие*/
$welcome = '';

if ($hour > 0 and $hour < 6):
    $welcome = "Доброй ночи";
elseif ($hour >= 6 and $hour < 12):
    $welcome = "Доброе утро";
elseif ($hour >= 12 and $hour < 18):
    $welcome = "Добрый день";
elseif ($hour >= 18 and $hour < 24):
    $welcome =  "Добрый вечер";
endif;

// сколько записей выводить на странице
$itemOnPage = 5;

//получаем все записи
$articles = getAllArticles();
//получаем все категории
$categories = getAllCategories();
// получаем всех пользователей
$users = getAllUsers();

$mainMenu = [
    'Главная' => SITE_URL,
    'Контакты' => '#',
    'Гостевая книга' => '/guestbook/',
    'Онлайн тест' => '/test/',
];

if(!isLogin() && isset($_COOKIE['hash']) && $_COOKIE['hash'] != ''){
    $sql = "SELECT * FROM users WHERE hash = '{$_COOKIE['hash']}'";
    $res = mysqli_query($link, $sql);
    if(mysqli_num_rows($res) > 0){
        $user = mysqli_fetch_assoc($res);
        $_SESSION['USER_LOGGED_IN'] = 1;
        $_SESSION['USER_LOGIN'] = $user['login'];
        $_SESSION['USER_ROLE'] = $user['role'];
        $hash = generateCookieHash();
        setcookie('hash', $hash, time() + 3600 * 24 * 7, '/');
        $sql = "UPDATE users SET hash = '{$hash}' WHERE login = '{$login}'";
        mysqli_query($link, $sql);
    }
}