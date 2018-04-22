<? include '../settings.php';
if(!isAdmin()) header('Location: ' . SITE_URL);
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
            <div class="pt-4">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Редактирование статей</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Редактирование категорий</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile1" aria-selected="false">Редактирование пользователей</a>
                  </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Название</th>
                                <th scope="col">Дата добавления</th>
                                <th scope="col">Дата редактирования</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?if(is_array($articles)):?>
                                    <?foreach ($articles as $row):?>
                                        <tr>
                                            <th scope="row"><?=$row['id'];?></th>
                                            <td><?=$row['title'];?></td>
                                            <td><?=date('d.m.Y H:i:s', $row['created_date'])?></td>
                                            <td><?= date('d.m.Y H:i:s', $row['update_date'])?></td>
                                   
                                            <td>
                                               <a href="editArticles.php?edit_Id=<?=$row['id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                               <a href="deleteArticles.php?del_Id=<?=$row['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?endforeach;?>           
                                <?else:?>  
                                    <h2>Произошла ошибка</h2>    
                                <?endIf;?>
                            </tbody>
                        </table>
                        <form action="addArticles.php" style="text-align: right; margin-bottom: 10px;">
                            <input type="submit" name="addButton" value="Добавить новую запись" class="btn btn-primary">
                        </form> 
                    </div> 
                    <!-- Редактирование категорий -->
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Название категорий</th>
                                <th scope="col">Описание</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?if(is_array($categories)):?>
                                    <?foreach ($categories as $row):?>
                                        <tr>
                                            <th scope="row"><?=$row['cat_id'];?></th>
                                            <td><?=$row['name'];?></td>
                                            <td><?=$row['description'];?></td>
                                   
                                            <td>
                                               <a href="editCategory.php?edit_Id_category=<?=$row['cat_id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                               <a href="deleteCategory.php?del_Id_category=<?=$row['cat_id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?endforeach;?>           
                                <?else:?>  
                                    <h2>Произошла ошибка</h2>    
                                <?endIf;?>
                            </tbody>
                        </table>
                        <form action="addCategory.php" style="text-align: right; margin-bottom: 10px;">
                            <input type="submit" name="addButton" value="Добавить новую запись" class="btn btn-primary">
                        </form> 
                    </div>               
                    <!-- Редактирование пользователей -->
                    <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Логин</th>
                                <th scope="col">Пароль</th>
                                <th scope="col">Email</th>
                                <th scope="col">Админ</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?if(is_array($users)):?>
                                    <?foreach ($users as $row):?>
                                        <tr>
                                            <th scope="row"><?=$row['id'];?></th>
                                            <td><?=$row['login'];?></td>
                                            <td><?=$row['email'];?></td>
                                            <td><?=$row['password'];?></td>
                                            <td><?=$row['role'];?></td>
                                   
                                            <td>
                                               <a href="editUser.php?edit_Id_users=<?=$row['id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                               <a href="deleteUser.php?del_Id_users=<?=$row['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?endforeach;?>
                                <?else:?>  
                                    <h2>Произошла ошибка</h2>
                                <?endIf;?>
                            </tbody>
                        </table>
                        <form action="addUser.php" style="text-align: right; margin-bottom: 10px;">
                            <input type="submit" name="addButton" value="Добавить нового пользователя" class="btn btn-primary">
                        </form> 
                    </div>


                </div>
                 
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

</div>
<!-- /.container -->

<!-- Footer -->
<?php include '../includes/footer.php' ?>

</body>

</html>
