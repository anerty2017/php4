<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="<?=SITE_URL?>">Какой-то логотип</a>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
          <? foreach($mainMenu as $name => $link): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?=$link?>"><?=$name?></a>
            </li>
          <? endforeach;?>
          <?if(isLogin()):?>
              <li class="nav-item"><a class="nav-link" >Привет, <?=$_SESSION['USER_LOGIN']?></a></li>
              <li class="nav-item"><a href="<?=SITE_URL?>logout.php" class="nav-link" >Выйти</a></li>
                <?if(isAdmin()):?>
                  <li class="nav-item"><a href="<?=SITE_URL?>admin/" class="nav-link" >Админка</a></li>
                <?endif;?>
          <?else:?>
              <li class="nav-item"><a href="<?=SITE_URL?>login/" class="nav-link" >Войти</a></li>
              <li class="nav-item"><a href="<?=SITE_URL?>registration/" class="nav-link" >Регистрация</a></li>
          <?endif;?>
      </ul>
    </div>
  </div>
</nav>