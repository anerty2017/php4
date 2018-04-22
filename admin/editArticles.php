<? include '../settings.php';
if(!isAdmin()) header('Location: ' . SITE_URL);

    if(isset($_GET['edit_Id'])){
        $sql = 'SELECT title, alias, image, category_id, introtext, full_text FROM articles WHERE id = ' . $_GET['edit_Id'];
        $res = mysqli_query($link, $sql);
        $setValue = mysqli_fetch_assoc($res); 
        $selectedCategory = $setValue['category_id'];
    }

    if(isset($_POST['edit'])){    
        $data = array();
        foreach ($_POST as $key => $item) {
            if(empty($item)) die('Вы не заполнили все поля');
            if($key == 'edit') continue;
            $data[$key] = htmlspecialchars(trim($item));  
        }

        $sql = "UPDATE `articles` SET title='".$data['title']."', image='".$data['image']."', introtext='".$data['introtext']."', full_text='".$data['full_text']."' WHERE id= '".$_GET['edit_Id']."'";

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

            <form class="pt-4 pb-4" method="POST" action="editArticles.php?edit_Id=<?=$_GET['edit_Id']?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Название статьи</label>
                    <input class="form-control" id="exampleFormControlInput1" name="title" value="<?=$setValue['title'];?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput2">Alias</label>
                    <input class="form-control" id="exampleFormControlInput1" name="alias" value="<?=$setValue['alias'];?>">
                </div>
                <div class="form-group">
                    <input type="file" name="image">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Выберите категорию</label>
                    <select name="category_id"  class="form-control" id="exampleFormControlSelect1">
                        <?foreach ($categories as $item):?>
                            <?if($item['cat_id'] == $article['category_id']):?>
                                <option value="<?=$item['cat_id']?>" selected><?=$item['name']?></option>
                            <?endif;?>
                            <option value="<?=$item['cat_id']?>"><?=$item['name']?></option>
                        <?endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Вводный текст</label>
                    <textarea name="introtext" class="form-control" id="exampleFormControlTextarea1" rows="3"><?=$setValue['introtext'];?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea2">Главное содержимое</label>
                    <textarea name="full_text" class="form-control" id="exampleFormControlTextarea1" rows="3"><?=$setValue['full_text'];?></textarea>
                </div>
                <input type="submit" name="edit" value="Сохранить" class="btn btn-primary">
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
