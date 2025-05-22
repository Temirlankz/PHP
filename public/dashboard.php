<?php
require_once '../classes/Database.php';
require_once '../classes/Encryption.php';
require_once '../classes/PasswordGenerator.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = new Database();
$conn = $db->getConnection();

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $length = (int)$_POST['length'];
    $upper = (int)$_POST['upper'];
    $lower = (int)$_POST['lower'];
    $num = (int)$_POST['num'];
    $special = (int)$_POST['special'];

    $generatedPassword = PasswordGenerator::generate($length, $upper, $lower, $num, $special);
    $_SESSION['generated_password'] = $generatedPassword;
    $message = "Generated Password: $generatedPassword";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
</head>
<body>
  <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
  <h3>Password Generator</h3>
  <form method="POST">
    Total Length: <input type="number" name="length" required><br>
    Uppercase Letters: <input type="number" name="upper" required><br>
    Lowercase Letters: <input type="number" name="lower" required><br>
    Numbers: <input type="number" name="num" required><br>
    Special Characters: <input type="number" name="special" required><br>
    <button type="submit">Generate Password</button>
  </form>
  <p><?php echo $message; ?></p>
  <?php if (!empty($_SESSION['generated_password'])): ?>
    <form action="save_password.php" method="POST">
      Service Name: <input type="text" name="service" required>
      <input type="hidden" name="password" value="<?php echo $_SESSION['generated_password']; ?>">
      <button type="submit">Save Password</button>
    </form>
  <?php endif; ?>
  <br>
  <a href="logout.php">Logout</a>
</body>
</html>
