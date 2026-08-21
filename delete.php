<?php
session_start();
$pdo= include_once 'database.php';
$post_id= $_GET['post_id'];

$sql = 'DELETE FROM posts WHERE id = :post_id';

$stmt= $pdo->prepare($sql);

$stmt-> bindparam(':post_id', $post_id, PDO::PARAM_INT);

$result= $stmt->execute();

if(!$result){
    echo 'Error Deleting post';
} else{
    echo 'Post Deleted Successfully';

    header('Location: index.php');
}


