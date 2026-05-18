<?php
session_start();
require("db.php");

if (!isset($_SESSION["User"])) {
    header("Location: ../visible/Login.php");
    die();
}

if (!isset($_GET["id"])) {
    header("Location: ../visible/threads.php");
    die();
}

$user = unserialize($_SESSION["User"]);

$UID = $user["UID"];
$postID = $_GET["id"];


$sql = "DELETE FROM posts WHERE ID = ?";
$stmt = $dbconn->prepare($sql);
$stmt->execute([$postID]);

header("Location: ../visible/threads.php");
die();
?>