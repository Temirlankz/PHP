<?php
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Encryption.php';
require_once 'classes/PasswordGenerator.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP passwoed</title>
</head>
<body>
  <h1>PHP passwopd </h1>
  <a href="public/register.php">Register</a> |
  <a href="public/login.php">Login</a>
</body>
</html>
