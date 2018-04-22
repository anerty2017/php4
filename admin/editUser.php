<?php
include '../settings.php';

if(!isAdmin()) header('Location: ' . SITE_URL);
    if(isset($_GET['edit_Id_users'])){

        $sql = 'SELECT * FROM users WHERE id = ' . $_GET['edit_Id_users'];
        $res = mysqli_query($link, $sql);
        $setValue = mysqli_fetch_assoc($res);
    }

    if(isset($_POST['edit'])){

    foreach ($_POST as $item){
        if(empty($item)){
            echo 'Вы не заполнили все поля';
            die();
        }
    }

    $login = mysqli_real_escape_string($link, strip_tags(trim($_POST['login'])));
    $password = mysqli_real_escape_string($link, strip_tags(trim($_POST['password'])));
    $email = mysqli_real_escape_string($link, strip_tags(trim($_POST['email'])));
    $password2 = $_POST['password2'];

    if($password == $password2){
        $sql = "SELECT * FROM users WHERE login = '{$login}' OR email = '{$email}'";
        $res = mysqli_query($link, $sql);
        $count = mysqli_num_rows($res);
        if($count == 0){
            $password = generatePassword($password);
            $hash = generateCookieHash();
            $sql = "UPDATE `users` SET 
                            login='".$login."',
                            email='".$email."', 
                            password='".$password."', 
                            hash='".$hash."' 
                    WHERE id='".$_GET['edit_Id_users']."'";

            $res = mysqli_query($link, $sql);
            header('Location: http://php8/admin/');
        }else{
            $msg = 'Извините, пользователь с таким логином или email уже существует';
        }
    }else{
        $msg = 'Пароли не совпадают!';
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
        <div class="col-md-9">
            <div class="pt-4">
                <h2>Редактирование пользователя</h2>
                <form class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="inputLogin">Логин:</label>
                        <div class="col-xs-9">
                            <input type="text" name="login" class="form-control" id="inputLogin" placeholder="Логин" value="<?=$setValue['login']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="inputEmail">Email:</label>
                        <div class="col-xs-9">
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?=$setValue['email']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="inputPassword">Пароль:</label>
                        <div class="col-xs-9">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Введите пароль" value="<?=$setValue['password']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="confirmPassword">Подтвердите пароль:</label>
                        <div class="col-xs-9">
                            <input type="password"  name="password2" class="form-control" id="confirmPassword" placeholder="Введите пароль ещё раз" value="<?=$setValue['password']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-9">
                            <input type="submit" name="edit" class="btn btn-primary" value="Редактирование">
                            <input type="reset" class="btn btn-default" value="Очистить форму">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container -->

<!-- Footer -->
<?php include '../includes/footer.php' ?>

</body>

</html>