<?php
session_start();
include_once('database.php');
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $name = $_FILES['image']['name'];
        $temp_location = $_FILES['image']['tmp_name'];
        $our_location = "image/";

        if(!empty($name)){
            move_uploaded_file($temp_location, $our_location.$name);
        }

        try{
            $sql = "insert into posts(title, content, image) values ('$title', '$content', '$name')";

            $result = $conn->query($sql);

            if($result){
                echo 'Post added successfully';
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();    
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="form.php" method="POST" enctype="multipart/form-data">
        title: <input type="text" name="title" placeholder="Post title here..." required> <br>
        Content: <textarea name="content" id="content" placeholder="Post content here..." required></textarea> <br>
        Image: <input type="file" name="image"> <br>
        <input type="submit" name="submit" value="Add Post">
        
    </form>
</body>
</html>