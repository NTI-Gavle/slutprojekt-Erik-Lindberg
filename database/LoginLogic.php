<?php
session_start();

include("db.php");

if (isset($_POST["username"])){
    $user=$_POST["username"];
}
if (isset($_POST["password"])){
   $pw=($_POST["password"]);
}

if(!(isset($pw) && isset($user))){
    header("Location: ../visible/Login.php");
}


$sql = "SELECT * FROM users WHERE Username=?";
$stmt = $dbconn->prepare($sql);

$data = array($user);
$stmt->execute($data);

$res = $stmt->fetch(PDO::FETCH_ASSOC);


if(password_verify($pw, $res["Password"])){
    unset($res["Password"]);
    $_SESSION["User"] = serialize($res);
    header("Location: ../visible/threads.php");
    die();
}
else{
    $_SESSION["loginError"] = "Wrong username or password";
    header("Location: ../visible/Login.php");
}



print_r($res);