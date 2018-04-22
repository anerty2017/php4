<? include '../settings.php';
if(!isAdmin()) header('Location: ' . SITE_URL);
    if(isset($_POST['deleteCategory'])){
        if(isset($_GET['del_Id_category']) && $_GET['del_Id_category'] !=0) {
            $sql = 'DELETE FROM categories WHERE cat_id = '. $_GET['del_Id_category'];
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
        <form class="pt-4 pb-4 col-md-1" method="POST" action="deleteCategory.php?del_Id_category=<?=$_GET['del_Id_category'];?>">
            <input type="submit" name="deleteCategory" value="Удалить" class="btn btn-primary">
        </form>
    </div>    
        <div class="clearfix"></div>
    

</div>
<!-- /.container -->

<!-- Footer -->
<?php include '../includes/footer.php' ?>

</body>

</html>
