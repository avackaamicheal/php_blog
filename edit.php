<?php 
session_start();
$pdo= include_once 'database.php';

if (isset($_GET['post_id'])){ 
    $post_id = $_GET['post_id'];
}
    



    if (isset($_POST['submit'])){

        $title = $_POST['title'];
        $content = $_POST['content'];
        $name = $_FILES['image']['name'];
        $temp_location = $_FILES['image']['tmp_name'];
        $our_location = "image/";

        if(empty($name)){
            move_uploaded_file($temp_location, $our_location.$name);
        }
            
        
        try {
            $sql = "UPDATE posts SET 
                title= :title, 
                content = :content,
                image = :name where id = :post_id" ;

        $stmt = $pdo->prepare($sql);

        $stmt->bindparam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindparam(':title', $title);
        $stmt->bindparam(':content', $content);
        $stmt->bindparam(':name', $name);

        $result = $stmt->execute();

        if ($result) {
            echo 'post updated successfully';

            header('Location:index.php');
        }
        } catch (PDOException $e) {
            
            echo"Error: " . $e->getmessage();
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) .'?post_id=' . urlencode($post_id)?>" method="POST" enctype="multipart/form-data">
            title: <input type="text" name="title" placeholder="Post title here..." required> <br>
            Content: <textarea name="content" id="content" placeholder="Post content here..." required></textarea> <br>
                Image: <input type="file" name="image"> <br>
            <input type="submit" name="submit" value="Update Post">
        
    </form>
</body>
</html>