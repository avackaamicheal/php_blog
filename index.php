<?php
session_start();
include_once('database.php');

try {
    $sql = "select * from posts";
    $result = $conn->query($sql);

    if($result->rowCount()>0){

        while($row=$result->fetch()){

            echo  "{$row ['title']} <br>";
            echo " {$row ['content']} <br>";
            echo  "<img src= image/{$row ['image']}<br>";
            echo "<a href='#'>Update</a> <a href='#'>Delete</a><br><hr>";
        }
    } else {
        echo "No posts found";
    }

} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>