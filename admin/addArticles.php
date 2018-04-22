<? include '../settings.php';
if(!isAdmin()) header('Location: ' . SITE_URL);
    if(isset($_POST['add'])){
        $data = array();
        foreach ($_POST as $key => $item) {
            if(empty($item)) die('Вы не заполнили все поля');
            if($key == 'add') continue;
            $data[$key] = "'" . mysqli_real_escape_string($link, strip_tags(trim($item), '<p><h2><a>')) . "'";
        }

        $data['created_date'] = time();
        $data['update_date'] = time();

        if(count($_FILES) > 0){
            $file = $_FILES['image'];
            if($file['type'] == 'image/jpeg'){
                $upload_dir = '../upload/images/';
                @mkdir($upload_dir);
                $image = time() . '_' . $file['name'];
                $data['image'] = "'" . $image . "'";
                copy($file['tmp_name'], $upload_dir . $image);
            }else{
                echo 'Ошибка';
            }
        }

        $values = implode(',', $data);

        $sql = 'INSERT INTO 
                    articles (title, alias, category_id, introtext,  full_text, created_date, update_date, image) 
                VALUES ('. $values . ')';

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

            <form class="pt-4 pb-4" method="POST" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Название статьи</label>
                    <input class="form-control" id="exampleFormControlInput1" name="title">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput2">Alias</label>
                    <input class="form-control" id="exampleFormControlInput2" name="alias">
                </div>
                <div class="form-group">
                    <input type="file" name="image">
                </div>
                <div class="form-group">
                     <label for="exampleFormControlSelect1">Выберите категорию</label>
                    <select name="category_id"  class="form-control" id="exampleFormControlSelect1">
                        <?foreach ($categories as $item):?>
                            <option value="<?=$item['cat_id']?>"><?=$item['name']?></option>
                        <?endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Вводный текст</label>
                    <textarea name="introtext" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea2">Главное содержимое</label>
                    <textarea name="full_text" class="form-control" id="exampleFormControlTextarea2" rows="3"></textarea>
                </div>

                <input type="submit" name="add" value="Добавить запись" class="btn btn-primary">
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