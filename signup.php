<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $userType = trim($_POST["userType"]);
    $branch = isset($_POST["branch"]) ? trim($_POST["branch"]) : null;
    $section = isset($_POST["section"]) ? trim($_POST["section"]) : null;

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        echo "Username already exists!";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users (username, password, user_type, branch, section) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$username, $hashedPassword, $userType, $branch, $section]);

    echo "Signup successful!";
}
?>