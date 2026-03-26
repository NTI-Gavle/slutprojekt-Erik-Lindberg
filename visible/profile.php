<?php
session_start();

if(!isset($_SESSION["User"])){
  header(Location: "Login.php"); 
}
$user = unserialize($_SESSION["User"]);
echo '<h1>'.$user["Username"].'</h1>';
?>