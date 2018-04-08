<?php
include '../settings.php';

if(isset($_POST['text'])){
  $file = fopen("messages.csv", "a");
  //$line = implode("\t", $_POST) . "\n";

    fputcsv($file, $_POST, ";");
  
 // file_put_contents("messages.txt", $line, FILE_APPEND);
  fclose($file);
  header('Location: '. SITE_URL . 'guestbook/');
}

if (($fp = fopen("messages.csv", "r")) !== FALSE) {
  $list = [];
  while (($data = fgetcsv($fp, 0, ";")) !== FALSE) {
    $list[] = $data;
  }
  fclose($fp);
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <? include_once '../includes/head.php' ?>
</head>

<body>

<!-- Navigation -->
<?php include_once '../includes/header.php'; ?>

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
              <div class="col-md-8">
            <h1>Гостевая книга</h1>
            <div class="list-group">
              <? foreach($list as $item): ?>
 
                      <h5 class="list-group-item-heading"><a href="mailto:<?= $item[1] ?>"><?= $item[0] ?></a></h5>
                      <p class="list-group-item-text"><?= nl2br($item[2]) ?></p>
                    
              <? endforeach;?>              
            </div>
            <form method="POST">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputName">Ваше имя</label>
                  <input name='name' type="name" class="form-control" id="inputName" placeholder="Как вас зовут">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail">Email</label>
                  <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="inputText">Address</label>
                <textarea name="text" type="text" class="form-control" id="inputText" rows="6" placeholder="Ваше сообщение..."></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Отправить сообщение</button>
            </form>
        </div>
            </div>

        </div>

        <!-- Sidebar -->
        <?php include '../includes/sidebar.php' ?>

        <div class="clearfix"></div>
    </div>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include '../includes/footer.php' ?>

</body>
</html>