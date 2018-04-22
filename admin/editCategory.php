<? include '../settings.php';
if(!isAdmin()) header('Location: ' . SITE_URL);
    if(isset($_GET['edit_Id_category'])){
        $sql = 'SELECT * FROM categories WHERE cat_id = ' . $_GET['edit_Id_category'];
        $res = mysqli_query($link, $sql);
        $setValue = mysqli_fetch_assoc($res);
    }

    if(isset($_POST['editCategory'])){    
        $data = array();
        foreach ($_POST as $key => $item) {
            if(empty($item)) die('Вы не заполнили все поля');
            if($key == 'editCategory') continue;
            $data[$key] = htmlspecialchars(trim($item));  
        }

        $sql = "UPDATE `categories` SET name='".$data['name']."', description='".$data['description']."' WHERE cat_id='".$_GET['edit_Id_category']."'";

        $res = mysqli_query($link, $sql);
        header('Location: http://php8/admin/');
    };
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
           <h1>Редактирование записи</h1>

            <form class="pt-4 pb-4" method="POST" action="editCategory.php?edit_Id_category=<?=$_GET['edit_Id_category']?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Название категории</label>
                    <input class="form-control" id="exampleFormControlInput1" name="name" value="<?=$setValue['name'];?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Описание</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?=$setValue['description'];?></textarea>
                </div>               

                <input type="submit" name="editCategory" value="Сохранить запись" class="btn btn-primary">
            </form>
        </div>
        <div class="clearfix"></div>
    </div>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include '../includes/footer.php' ?>

</body>

</html>
