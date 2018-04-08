<? include 'settings.php';?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <? include_once 'includes/head.php' ?>
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
            <h1 class="my-4">Заголовок страницы
                <small></small>
            </h1>
            <hr>
            <h4><?= $welcome ?>, Гость!</h4>
            <small>Cейчас <?= $date?></small>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <a href="#">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="/img/<?=$article['image'];?>" alt="">
                    </a>
                </div>
                <div class="col-md-8">
                    <h3><?=$article['title'];?></h3>
                    <p><?=$article['full_text'];?></p>
                </div>
            </div> 
            <hr>


        </div>

        <!-- Sidebar -->
        <?php include 'includes/sidebar.php' ?>

        <div class="clearfix"></div>
    </div>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include 'includes/footer.php' ?>

</body>

</html>
