<?php
session_start();

include("db.php");

if(!isset($_SESSION["User"])){
    header("Location: Login.php"); 
  }

if (isset($_POST["content"])){
    $pc=$_POST["content"];
}

$user = unserialize($_SESSION["User"]);

$pid = $user["UID"];

if(!isset($pc)){
    header("Location: ../visible/threads.php");
}


$sql = "INSERT INTO posts (PosterID, PostContent) VALUE (?, ?)";
$stmt = $dbconn->prepare($sql);

$data = array($pid, $pc);
$stmt->execute($data);

$res = $stmt->fetch(PDO::FETCH_ASSOC);

header("Location: ../visible/threads.php");