<?php
$pdo = include_once 'database.php';

if(isset($_POST['submit'])){
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    session_start();

    try{
        $sql = 'INSERT INTO users(first_name, last_name, email, password, role) VALUES(:first_name, :last_name, :email, :password, :role)';
    
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindparam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindparam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindparam(':email', $email, PDO::PARAM_STR);
        $stmt->bindparam(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $stmt->bindparam(':role', $role, PDO::PARAM_STR);
    
        $result = $stmt->execute();

        if ($result){
            echo "You have successfully registered, You can login here";

            header('Location:login.php');
        }



    } catch(PDOException $e){
        echo "Error: ". $e->getMessage();
    }

}

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        First Name: <input type="text" name="firstname" required> <br>
        Last Name: <input type="text" name="lastname" required> <br>
        email: <input type="email" name="email" required> <br>
        Password: <input type="text" name="password" required> <br>
        Role:
        <select name="role" id="role">
            <option value="admin">Subscriber</option>
            <option value="admin">Author  </option>
        </select><br>
        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>