<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: student_login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $subject = $_POST['subject'];
    $clarity = intval($_POST['clarity']);
    engagement = intval($_POST['engagement']);
    $instructor = intval($_POST['instructor']);
    $resources = intval($_POST['resources']);
    $overall = intval($_POST['overall']);

    $stmt = $conn->prepare("INSERT INTO feedback (user_id, subject, clarity, engagement, instructor, resources, overall) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $subject, $clarity, $engagement, $instructor, $resources, $overall]);

    echo "Feedback submitted successfully!";
}
?>