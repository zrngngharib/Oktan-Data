<?php
include '../../includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("❌ ID not provided.");
}

$stmt = $conn->prepare("SELECT * FROM checkup WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>پرینتی پشکنین</title>
</head>
<body>
    <h1>وردەکاری پشکنین</h1>
    <?php foreach ($data as $field => $value): ?>
        <p><strong><?= htmlspecialchars($field) ?>:</strong> <?= htmlspecialchars($value) ?></p>
    <?php endforeach; ?>
    <script>
        window.onload = () => window.print();
    </script>
</body>
</html>
