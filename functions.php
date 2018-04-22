<?php

//1 host, 2 user, 3 password, 4 db_name
$link = mysqli_connect('localhost', 'root', '', 'blog');
if(mysqli_errno($link)) die('Ошибка подключения к БД!');

//получаем записи
function getArticles($page, $itemOnPage){
	global $link;
    $startPage = ($page * $itemOnPage) - $itemOnPage;
    $sql = 'SELECT * FROM articles ORDER BY id DESC LIMIT ' . $startPage . ', ' . $itemOnPage ;
	$res = mysqli_query($link, $sql);
    if($res) {
        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $rows;
    }else{
        echo 'Ой, что - то пошло не так!';
    }
}

function getAllArticles(){
	global $link;
    $sql = 'SELECT * FROM articles ORDER BY id DESC';
	$res = mysqli_query($link, $sql);
    if($res) {
        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $rows;
    }else{
        echo 'Ой, что - то пошло не так!';
    }
}

//Получаем запись
function getArticle($article_id){
	global $link;
	$sql = 'SELECT * FROM articles WHERE id = ' . $article_id;
	$res = mysqli_query($link, $sql);
	if($res) {
	    $row = mysqli_fetch_assoc($res);
        return $row;
    }else{
	    header('Location: ' . SITE_URL . '404.php');
    }
}

//Получаем список категорий
function getAllCategories(){
    global $link;
    $sql = 'SELECT * FROM categories';
    $res = mysqli_query($link, $sql);
    if($res) {
        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $rows;
    }else{
        echo 'Ой, что - то пошло не так!';
    }
}

//Получаем записи по категории
function getArticlesByCategory($cat_id){
    global $link;
    $sql = 'SELECT id, title, introtext, full_text, image FROM articles WHERE category_id = ' . $cat_id . ' ORDER BY id DESC';
    $res = mysqli_query($link, $sql);
    if($res) {
        $row = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $row;
    }else{
        header('Location: ' . SITE_URL . '404.php');
    }
}

function getAllUsers() {
    global $link;
    $sql = 'SELECT id, login, email, password, role FROM users';
    $res = mysqli_query($link, $sql);
    if ($res) {
        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $rows;
    } else {
        echo "Что-то пошло не так!";
    }
}

function findArticles($query){
    global $link;
    $sql = 'SELECT * FROM articles WHERE title LIKE "%' . $query . '%" ORDER BY id DESC';
    $res = mysqli_query($link, $sql);
    if($res) {
        $row = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $row;
    }else{
        return 'К сожалению, поиск не дал результатов по запросу: <strong>"' . $query . '"</strong>';
    }
}

// получаем сколько всего записей в БД
function AllPages() {
    global $link;
    $sql = "SELECT * FROM articles";
    $res = mysqli_query($link, $sql);
    if($res) {
        $total_results = mysqli_num_rows($res);
        return $total_results;
    }else{
        echo 'Ой, что - то пошло не так!';
    }
}

function debug($data){
    print '<br><br><pre>';
    print_r($data) ;
    print '</pre>';
}

function generatePassword($password){
    return md5('dasdfasdfasdlkhigeqlkjfnvaliuherliu' . md5($password) . 'aslkdfnaiuhfelidlif');
}

function generateCookieHash(){
    return md5(rand(1, 9999));
}

function isLogin(){
    if($_SESSION['USER_LOGGED_IN'] == 1) return true;
    else return false;
}

function isAdmin(){
    if($_SESSION['USER_ROLE'] == 1) return true;
    else return false;
}