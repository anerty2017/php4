<? include '../settings.php';
    if(isset($_POST['deleteArticle'])){
        if(isset($_GET['del_Id']) && $_GET['del_Id'] !=0) {
            $sql = 'DELETE FROM articles WHERE id = '. $_GET['del_Id'];
            $res = mysqli_query($link, $sql);
            if($res) {
            $msg = 'запись удалена';
            header('Location: http://php8/admin/');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <? include_once '../includes/head.php'; ?>
</head>

<body>

<!-- Navigation -->
<?php include_once '../includes/header.php'; ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Content -->
        <div class="col-md-12">
            <h3>Вы действительно хотите удалить запись?</h3>
            <p><?if($msg) echo $msg;?></p>
        </div>
    </div>
    <div class="row">
        <form class="pt-4 pb-4 col-md-3" method="POST" action="index.php">
            <input type="submit" value="Вернуться на главную" class="btn btn-primary">
        </form>
        <form class="pt-4 pb-4 col-md-1" method="POST" action="deleteArticles.php?del_Id=<?=$_GET['del_Id'];?>">
            <input type="submit" name="deleteArticle" value="Удалить" class="btn btn-primary">
        </form>
    </div>    
    <div class="clearfix"></div>
    

</div>
<!-- /.container -->

<!-- Footer -->
<?php include '../includes/footer.php' ?>

</body>

</html>
