<?php
require_once '../classes/Database.php';
require_once '../classes/Encryption.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$db = new Database();
$conn = $db->getConnection();

$service = $_POST['service'];
$password = $_POST['password'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT aes_key_encrypted, password_hash FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($encrypted_key, $hash);
$stmt->fetch();
$stmt->close();

$plain_password = $_POST['password'];
$key = openssl_decrypt($encrypted_key, 'AES-256-CBC', $_SESSION['password'], 0, substr($_SESSION['password'], 0, 16));
$encrypted_password = Encryption::encrypt($plain_password, $key);

$stmt = $conn->prepare("INSERT INTO saved_passwords (user_id, service_name, encrypted_password) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $service, $encrypted_password);
$stmt->execute();

header('Location: dashboard.php');
