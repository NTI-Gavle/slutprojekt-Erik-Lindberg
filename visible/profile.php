<?php
session_start();
require("../database/db.php");

if(!isset($_SESSION["User"])){
    header("Location: Login.php"); 
  }
  $user = unserialize($_SESSION["User"]);

  $pid = $user["UID"];

  $sql = "SELECT p.PosterID, p.PostContent, p.ReplyID, p.ReplyCount, p.LikeCount, u.Username, u.Bio FROM users u LEFT JOIN posts p ON u.UID = p.PosterID WHERE u.UID=? ORDER BY ID";
  $stmt = $dbconn->prepare($sql);
  $stmt->execute([$pid]);
  $p = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <div class="col">
    <div class="row"><?php echo '<h1 class="text-light">'.$user["Username"].'</h1>';?></div>
    <?php if(count($p) > 0): ?>
      <div class="row">
        <div class="Bio text-light">
          <?= htmlspecialchars($p[0]["Bio"]) ?>
        </div>
      </div>
    <?php foreach($p as $post): ?>
      <div class="ThreadContainer p-3 border-dark-subtle border-1 rounded">
        <div class="ThreadContent">
          <p class="text-light">
            <?= htmlspecialchars($post["PostContent"]) ?>
          </p>
        </div>
        <small class="text-secondary">
          Poster: <?= htmlspecialchars($post["Username"]) ?>
        </small>
      </div>
    <?php endforeach; ?>
    <?php else: ?>
      <p class="text-light">No posts made yet</p>
    <?php endif; ?>
  </div>
  <div class="col"></div>
</div>
</body>
</html>