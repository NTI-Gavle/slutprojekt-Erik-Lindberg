<?php
session_start();

$errormsg="";
if(isset($_SESSION["loginError"])){
    $errormsg = $_SESSION["loginError"];
    unset($_SESSION["loginError"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../public/css/LoginSignup.css">
</head>
<body>
    

<?php
if($errormsg!=""){
echo "<p>" . $errormsg . "<p>";
}


?>
<div class="container">
<div class="LogCont">
    <form action="../database/RegisterLogic.php" method="POST">
        <div class="Space"></div>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Register</button>
    </form>
    <a href="Login.php">Already have an account? Log in!</a>
</div>
</div>
</body>
</html>