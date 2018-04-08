<?php
include '../settings.php';
if(!isset($_SESSION['test']) and !isset($_POST['q'])){
// Если первый запуск теста, то инициализируем переменные
$q = 0; // Номер текущего вопроса
$title = 'Пройдите тест';
}else{
// Создаем сессионную переменную test, содержащую массив ответов
if($_POST['q'] != '1')
$_SESSION['test'][] = $_POST['answer'];
$q = $_POST['q'];
$title = $_POST['title'];
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <? include_once '../includes/head.php' ?>
</head>

<body>

<!-- Navigation -->
<?php include_once '../includes/header.php'; ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Content -->
        <div class="col-md-9">

            <!-- Page Heading -->
            <h1 class="my-4">Заголовок страницы
                <small></small>
            </h1>
            <hr>
            <h4><?= $welcome ?>, Гость!</h4>
            <small>Cейчас <?= $date?></small>
            <hr>

<table class="w-100" border="1" align='center'>

<tr>
	<td align="center">
		<!-- Верхняя часть страницы -->
		<table width="100%">
			<tr>
				<td align="center">
					<h1><?= $title; ?></h1>
					<p><a href='/index.php'>Прервать тест и вернуться на сайт</a></p>
				</td>
			</tr>
		</table>
		<!-- Верхняя часть страницы -->
	</td>
</tr>

<tr>
	<td>
		<!-- Область основного контента -->
		<?php
// В зависимости от номера вопроса,
// подключаем соответствующий файл с вопросами
switch($q){
	case 0:
		include 'start.php';
	break;
	case 1:
		include 'q1.php';
	break;
	case 2:
		include 'q2.php';
	break;
	case 3:
		include 'q3.php';
	break;
	default:
	include 'result.php';
}
?>
		<!-- Область основного контента -->
	</td>
</tr>
</table>

            <hr>
        </div>

        <!-- Sidebar -->
        <?php include '../includes/sidebar.php' ?>

        <div class="clearfix"></div>
    </div>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include '../includes/footer.php' ?>

</body>

</html>