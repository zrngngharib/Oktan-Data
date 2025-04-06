<?php
include '../../includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("❌ ID not provided.");
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=checkup_$id.xls");

$stmt = $conn->prepare("SELECT * FROM checkup WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

echo "Field\tValue\n";
foreach ($data as $field => $value) {
    echo "$field\t$value\n";
}
?>
