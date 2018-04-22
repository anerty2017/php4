<?php
session_start();
session_destroy();
setcookie('hash', null, time() - 3600, '/');
header('Location: /');