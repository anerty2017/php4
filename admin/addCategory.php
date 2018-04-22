<? include '../settings.php';
    if(isset($_POST['addCategory'])){
        $dataCategory = array();
        foreach ($_POST as $key => $item) {
            if(empty($item)) die('Вы не заполнили все поля');
            if($key == 'addCategory') continue;
            $dataCategory[$key] = "'" . strip_tags(htmlspecialchars(trim($item)), '<h3><br><a><p>') ."'";
        }
        $values = implode(',', $dataCategory);

        $sql = 'INSERT INTO categories (name, description) VALUES ('. $values .')';
        $res = mysqli_query($link, $sql);
        if($res) {
            $msg = 'запись добавлена';
            header('Location: http://php8/admin/');
        }
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
           <h1>Добавление новой записи</h1>
           <p><?if($msg) echo $msg;?></p>

            <form class="pt-4 pb-4" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Название категории</label>
                    <input class="form-control" id="exampleFormControlInput1" name="name">
                </div> 
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Описание</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>               

                <input type="submit" name="addCategory" value="Добавить запись" class="btn btn-primary">
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
