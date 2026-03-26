<?php
session_start();
include "aside.php";

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
</head>
<body>

</body>
</html>