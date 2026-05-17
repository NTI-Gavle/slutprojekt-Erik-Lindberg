<?php
session_start();
require("../database/db.php");

$theme = $_SESSION["theme"] ?? "dark";
$user = unserialize($_SESSION["User"]);
$pid = $user["UID"];

if(!isset($_SESSION["User"])){
    header("Location: Login.php"); 
  }

  $sql = "SELECT p.ID, p.PosterID, p.PostContent, p.ReplyID, p.ReplyCount, p.LikeCount, u.Username, u.Bio FROM users u LEFT JOIN posts p ON u.UID = p.PosterID WHERE u.UID=? ORDER BY ID";
  $stmt = $dbconn->prepare($sql);
  $stmt->execute([$pid]);
  $u = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["updbio"])) {
    $bio = trim($_POST["edbio"]);

    $sql = "UPDATE users SET Bio = ? WHERE UID = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->execute([$bio, $pid]);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/kwitter.css">
    <script src="../public/js/app.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body class="<?= $theme === "light" ? "light-mode" : "dark-mode" ?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-md-2">
      <?php include "aside.php"; ?>
    </div>
    <div class="col-12 col-md-8 Threads">
      <div class="row">
        <h1 class="text-light"><?= $user["Username"] ?></h1>
      </div>
      <?php if(count($u) > 0): ?>
        <div class="row" id="bio">
          <div class="Bio text-light">
            <?= htmlspecialchars($u[0]["Bio"]) ?>
          </div>
        </div>
        <button class="btn btn-secondary btn-sm mt-2" id="biobtn" onclick="toggleBioEdit()">Edit Bio</button>
        <div class="row mt-3">
          <div id="bioEditor" class="mb-3" style="display: none;">
            <form method="POST" action="" class="text-light">
              <textarea name="edbio" id="edbio" class="form-control" rows="3"><?= htmlspecialchars($u[0]["Bio"] ?? "") ?></textarea>
              <button type="submit" name="updbio" class="btn btn-primary btn-sm">Save Bio</button>
              <button type="button" class="btn btn-outline-light btn-sm" onclick="toggleBioEdit()">Cancel</button>
            </form>
          </div>
          <?php foreach($u as $p): ?>
            <div class="ThreadContainer p-3 border-dark-subtle border-1 rounded">
              <div class="ThreadContent">
                <p class="text-light"><?= htmlspecialchars($p["PostContent"]) ?></p>
              </div>
              <small class="text-secondary">Poster: <?= htmlspecialchars($p["Username"]) ?></small>
              <?php if ($user["UID"] == $p["PosterID"] || $user["UID"] == 1): ?>
                <div class="mt-2">
                  <a href="../database/DeletePostLogic.php?id=<?= $p["ID"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this post?')">Delete</a>
                </div>
              <?php endif; ?>
            </div>
         <?php endforeach; ?>
      <?php else: ?>
        <p class="text-light">No posts made yet</p>
      <?php endif; ?>
    </div>
      
  </div>
  <div class="col-12 col-md-2 d-flex justify-content-center align-items-start pt-4">
    <canvas id="Canvas" width="160" height="160"></canvas>
  </div>
</div>
</body>
</html>