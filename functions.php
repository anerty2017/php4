<?php

$link = mysqli_connect('localhost', 'root', '', 'blog');

function getAllArticles(){
	global $link;
	$sql = 'SELECT id, title, introtext, image FROM articles';
	$res = mysqli_query($link, $sql);
	$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $rows;
}

function getArticle($article_id) {
	global $link;
	$sql = 'SELECT title, full_text, image FROM articles WHERE id = ' . $article_id;
	$res = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($res);
	return $row;
}

function getArticleSearch($searchTextQuery) {
	global $link;
	$sql = "SELECT id, title, introtext, image FROM articles WHERE title LIKE '%" . $searchTextQuery . "%'";
	$res = mysqli_query($link, $sql);
	$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $row;
}

function getSideBar() {
	global $link;
	$sql = 'SELECT id, name, description FROM categories';
	$res = mysqli_query($link, $sql);
	$row = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $row;
}

function getCategoryArticles($category_id){
	global $link;
	$sql = 'SELECT title, introtext, image FROM articles WHERE category_id = ' . $category_id;
	$res = mysqli_query($link, $sql);
	$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $rows;
}

?>