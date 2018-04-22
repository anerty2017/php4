<? include 'settings.php';
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }else $page = 1;
    $articles = getArticles($page, $itemOnPage);
    $total_pages = AllPages();
    $allPages = ceil($total_pages / $itemOnPage);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <? include_once 'includes/head.php'; ?>
</head>

<body>

<!-- Navigation -->
<?php include_once 'includes/header.php'; ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Content -->
        <div class="col-md-9">

            <!-- Page Heading -->
            <h1 class="my-4">Главная
                <small></small>
            </h1>
            <hr>
            <h4><?= $welcome ?>, Гость!</h4>
            <small>Cейчас <?= $date?></small>
            <hr>

			<?php foreach($articles as $row): ?>
			
			<div class="row">
                <div class="col-md-4">
                    <a href="#">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="upload/images/<?=$row['image'];?>" alt="">
                    </a>
                </div>
                <div class="col-md-8">
                    <h3><?=$row['title'];?></h3>
                    <p><?=$row['introtext'];?></p>
					<!-- Формируем ссылочку для GET запроса -->
                    <a class="btn btn-primary" href="/article.php?id=<?=$row['id'];?>">Читать далее</a>
                </div>
            </div>
			<hr>
			<?php endforeach;?>

        </div>

        <!-- Sidebar -->
        <?php include 'includes/sidebar.php' ?>

        <div class="clearfix"></div>
    </div>
    <?php
    $_GET['allPages']=$allPages;
    $_GET['pageNum']=$page;
    include 'includes/pagination.php';
    ?>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include 'includes/footer.php' ?>

</body>

</html>
