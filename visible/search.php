<?php
session_start();
require_once("../database/db.php");

$theme = $_SESSION["theme"] ?? "dark";

if(!isset($_SESSION["User"])){
    header("Location: Login.php");
}

$posts = [];

$search = $_GET["search"] ?? "";
$sql = "SELECT p.ID, p.PosterID, p.PostContent, p.ReplyID, p.ReplyCount, p.LikeCount, u.Username FROM posts p LEFT JOIN users u ON p.PosterID = u.UID WHERE PostContent LIKE ? ORDER BY ID";

$stmt = $dbconn->prepare($sql);
$stmt->execute(["%$search%"]);

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>

    <link rel="stylesheet" href="../public/css/kwitter.css?v=1">
    <script src="../public/js/app.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body class="<?= $theme === "light" ? "light-mode" : "dark-mode" ?>">

<div class="row">
  <div class="col-12 col-md-2 Sidebar"><?php include "aside.php";?></div>
  <div class="col-12 col-md-8 Threads">
    <form method="GET" action="">
      <input class="Searchbar form-control"  type="text" name="search" placeholder="Search" value="<?= htmlspecialchars($search)?>">
    </form>
    <?php if(count($posts) > 0):?>
    <?php foreach($posts as $p):?>
    <div class="ThreadContainer p-3 border-1 border-dark-subtle rounded">
      <p class="text-light"><?=htmlspecialchars($p["PostContent"])?></p>
      <small class="text-secondary">Poster: <?=htmlspecialchars($p["Username"])?></small>
    </div>
    <?php endforeach;?>
    <?php else:?>
      <p class="text-light">No posts found.</p>
    <?php endif;?>
  </div>
    <div class="col-12 col-md-2 d-flex justify-content-center align-items-start pt-4">
    <canvas id="Canvas" width="160" height="160"></canvas>
  </div>
</div>

</body>
</html>