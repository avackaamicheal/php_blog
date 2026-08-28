<?php
session_start();
$pdo = include_once 'database.php';

if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email";

    $stmt = $pdo->prepare($sql);

    $stmt->bindparam(':email', $email, PDO::PARAM_STR);

    $stmt->execute();

    $result =$stmt->fetch(PDO::FETCH_ASSOC);

    $user = $result['email'];
    $password_hash= $result['password'];

        // check user and password match
    if($user && password_verify($password, $password_hash)){

        // regenerate session id, prevents session fixation attacks
        session_regenerate_id();
        
        $_SESSION['email'] = $user;
        $_SESSION['user_id'] = $result['id'];
        
        echo "Logged in successfully";
        
        } else{
            
            echo "Invalid Email or Password";
    }
    
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        Email: <input type="email" name="email"><br>
        Password: <input type="text" name="password"><br>
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>