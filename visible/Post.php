<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../public/css/LoginSignup.css">
</head>
<body>
    


<div class="container">
    <div class="PostCont">
        <form action="../database/PostLogic.php" method="POST">
            <div class="Space"></div>
            <input type="text" name="content" placeholder="What's on your mind?">
            <button type="submit">Post</button>
        </form>
    </div>
</div>
</body>
</html>