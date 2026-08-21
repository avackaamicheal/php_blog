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
            echo  '<img src= "image/'. $row ['image'].'" style= "height:100px; width: 100px;"><br>';
            echo "<a href='edit.php?post_id={$row['id']}'>Edit</a> <a href='delete.php?post_id={$row['id']}'>Delete</a><br><hr>";
        }
    } else {
        echo "No posts found";
    }

} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>