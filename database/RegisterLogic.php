<?php
session_start();

include("db.php");

if (isset($_POST["username"])){
    $user=$_POST["username"];
}
if (isset($_POST["password"])){
    $pw=$_POST["password"];
}

if(!(isset($pw) && isset($user))){
    header("Location: ../visible/Register.php");
}


$sql = "SELECT * FROM users WHERE Username=?";
$stmt = $dbconn->prepare($sql);

$data = array($user);
$stmt->execute($data);

$res = $stmt->fetch(PDO::FETCH_ASSOC);

if(!empty($res)){
    $_SESSION["loginError"] = "User Already Exists, Please Choose Another Username";
    header("Location: ../visble/Register.php");
    die();
}


$sql = "INSERT INTO users (Username,Password) VALUE (?,?)";
$stmt = $dbconn->prepare($sql);

$data = array($user, password_hash($pw, PASSWORD_DEFAULT));
$stmt->execute($data);

$res = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION["loginError"] = "Registration Success";
header("Location: ../visible/Login.php");