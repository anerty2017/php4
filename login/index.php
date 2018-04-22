<? include '../settings.php';
if(isLogin()) header('Location: ' . SITE_URL);
if(isset($_POST['auth'])){
    foreach ($_POST as $item){
        if(empty($item)){
            echo 'Вы не заполнили все поля';
            die();
        }
    }

    $login = mysqli_real_escape_string($link, strip_tags(trim($_POST['login'])));
    $password = mysqli_real_escape_string($link, strip_tags(trim($_POST['password'])));
    $password = generatePassword($password);

    $sql = "SELECT * FROM users WHERE login = '{$login}'";
    $res = mysqli_query($link, $sql);
    $count = mysqli_num_rows($res);
    if($count > 0){
        $user = mysqli_fetch_assoc($res);
        if($password == $user['password']){
            $_SESSION['USER_LOGGED_IN'] = 1;
            $_SESSION['USER_ROLE'] = $user['role'];
            $_SESSION['USER_LOGIN'] = $user['login'];
            if($_POST['rememberme']){
                $hash = generateCookieHash();
                setcookie('hash', $hash, time() + 3600, '/');
                $sql = "UPDATE users SET hash = '{$hash}' WHERE login = '{$login}'";
                mysqli_query($link, $sql);
            }
            header('Location:' . SITE_URL);
        }else{
            $msg = 'Неверный логин или пароль!';
        }
    }else{
        $msg = 'Неверный логин или пароль!';
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
                <h2>Авторизация</h2>
                <form class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="inputLogin">Логин:</label>
                        <div class="col-xs-9">
                            <input type="text" name="login" class="form-control" id="inputLogin" placeholder="Логин">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="inputPassword">Пароль:</label>
                        <div class="col-xs-9">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Введите пароль">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="rememberme">Запомнить меня
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-9">
                            <input type="submit" name="auth" class="btn btn-primary" value="Авторизироваться">
                            <input type="reset" class="btn btn-default" value="Очистить форму">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include '../includes/sidebar.php' ?>
        <div class="clearfix"></div>
    </div>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include '../includes/footer.php' ?>

</body>

</html>
