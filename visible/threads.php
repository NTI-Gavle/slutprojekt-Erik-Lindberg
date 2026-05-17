<?php
session_start();
require_once("../database/db.php");

$posts = [];


if(!isset($_SESSION["User"])){
    header("Location: Login.php"); 
  }

  $pt = "";
  $sql = "SELECT p.ID, p.PosterID, p.PostContent, p.ReplyID, p.ReplyCount, p.LikeCount, u.Username FROM posts p LEFT JOIN users u ON p.PosterID = u.UID WHERE PostContent LIKE ? ORDER BY ID";

  $stmt = $dbconn->prepare($sql);
  $stmt->execute(["%$pt%"]);
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/kwitter.css?v=1">
    <script src="../public/js/app.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
<div class="row">
  <div class="col Sidebar"><?php include "aside.php";?></div>
  <div class="col Threads">
    <?php if(count($posts) > 0):?>
      <?php foreach($posts as $p):?>
        <div class="ThreadContainer p-3 border-dark-subtle border-1 rounded">
          <div class="ThreadContent">
            <p class="text-light"><?= htmlspecialchars($p["PostContent"]) ?></p>
          </div>
          <small class="text-secondary">Poster: <?=htmlspecialchars($p["Username"])?></small>
        </div>
      <?php endforeach;?>
      <?php else:?>
        <p class="text-light">No posts found.</p>
      <?php endif;?>
    </div>
  <div class="col"><a href="Post.php">Post</a></div>
</div>
</body>
</html>