<?php

session_start();

unset($_SESSION['name'], $_SESSION['user_id'], $_SESSION['role'], $_SESSION['email']);

session_destroy();

header('Location:login.php');