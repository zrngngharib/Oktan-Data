<?php
include '../../includes/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM checkup WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);
?>
