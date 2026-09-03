<?php
session_start();

if(!isset($_SESSION['email'])){

    header('Location:login.php');

} else{
    echo "Welcome to the Dashboard {$_SESSION['name']} You're are an {$_SESSION['role']} <a href='logout.php'>Logout</a>";
}