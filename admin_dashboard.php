<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: admin_login.html");
    exit();
}

$stmt = $conn->prepare("
    SELECT u.branch, u.section, f.subject, f.clarity, f.engagement, f.instructor, f.resources, f.overall
    FROM feedback f
    JOIN users u ON f.user_id = u.id
");
$stmt->execute();
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Admin Dashboard - Feedback Report</h2>
    <table class="feedback-table">
        <thead>
            <tr>
                <th>Branch & Section</th>
                <th>Subject</th>
                <th>Clarity</th>
                <th>Engagement</th>
                <th>Instructor</th>
                <th>Resources</th>
                <th>Overall</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedbacks as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['branch']) ?> - <?= htmlspecialchars($row['section']) ?></td>
                    <td><?= htmlspecialchars($row['subject']) ?></td>
                    <td><?= htmlspecialchars($row['clarity']) ?></td>
                    <td><?= htmlspecialchars($row['engagement']) ?></td>
                    <td><?= htmlspecialchars($row['instructor']) ?></td>
                    <td><?= htmlspecialchars($row['resources']) ?></td>
                    <td><?= htmlspecialchars($row['overall']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
