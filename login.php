<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['username'] = $user['username'];

        if ($user['user_type'] === "admin") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: select_subject.html");
        }
        exit();
    } else {
        echo "Invalid credentials!";
    }
}
?>