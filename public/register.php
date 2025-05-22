<?php
require_once '../classes/Database.php';
require_once '../classes/User.php';

session_start();

$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->register($username, $password)) {
        $message = "User registered successfully.";
    } else {
        $message = "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
</head>
<body>
  <h2>Register</h2>
  <form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
  </form>
  <p><?php echo $message; ?></p>
  <a href="login.php">Already have an account? Login</a>
</body>
</html>
