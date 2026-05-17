<?php
session_start();

if (isset($_POST["theme"])) {
    $_SESSION["theme"] = $_POST["theme"];
    header("Location: ../visible/settings.php");
    die;
}