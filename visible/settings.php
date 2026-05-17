<?php
session_start();

$theme = $_SESSION["theme"] ?? "dark";

if(!isset($_SESSION["User"])){
    header("Location: Login.php"); 
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
<div class="row">
  <div class="col-12 col-md-2"><?php include "aside.php";?></div>
  <div class="col-12 col-md-8">
    <h3 class="text-light">Theme Settings</h3>
    <form method="POST" action="../database/theme.php">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="theme" value="dark"
        <?= $theme === "dark" ? "checked" : "" ?>>
        <label class="form-check-label text-light">Dark Mode</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="theme" value="light"
        <?= $theme === "light" ? "checked" : "" ?>>
        <label class="form-check-label text-light">Light Mode</label>
      </div>
        <button class="btn btn-primary mt-3" type="submit">Save</button>
    </form>
  </div>
    <div class="col-12 col-md-2 d-flex justify-content-center align-items-start pt-4">
    <canvas id="Canvas" width="160" height="160"></canvas>
  </div>
</div>
</body>
</html>