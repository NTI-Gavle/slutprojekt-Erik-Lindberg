<?php
session_start();
require_once("../database/db.php");

if(!isset($_SESSION["User"])){
    header("Location: Login.php"); 
  }
  $sql = "SELECT p.PosterID, p.PostContent, p.ReplyID, p.ReplyCount, p.LikeCount, r.ReplyContent, r.LikeCount, r.PostID FROM posts p JOIN replies r ON p.ID = r.PostID WHERE p.ID=? ORDER BY p.ID, r.PostID";
    $stmt = $dbconn->prepare($sql);
    $stmt->execute([$POS]);
    $p = $stmt->fetch(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/kwitter.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
<div class="row">
  <div class="col"><?php include "aside.php";?></div>
  <div class="col Threads">
    <div id="Thread-container">
        <div id="ThreadContent">
            <p><strong><?= htmlspecialchars($p["PostContent"]) ?></strong></p>
        </div>
      </div>
      <button type="button" class="likebtn">Like</button>
      <button type="button" class="replybtn">Reply</button>
    </div>
  </div>
  <div class="col"></div>
</div>
</body>
</html>