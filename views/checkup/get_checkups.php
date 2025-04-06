<?php
include '../../includes/db.php';

$year = $_GET['year'] ?? null;
$month = $_GET['month'] ?? null;
$page = $_GET['page'] ?? 1;
$limit = 30;
$offset = ($page - 1) * $limit;

if (!empty($year) && !empty($month)) {
    // filter by date
    $month = str_pad($month, 2, '0', STR_PAD_LEFT);
    $start = "$year-$month-01";
    $end = date("Y-m-t", strtotime($start));

    $stmt = $conn->prepare("SELECT id, username, current_datetime FROM checkup WHERE DATE(current_datetime) BETWEEN ? AND ? ORDER BY current_datetime DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ssii", $start, $end, $limit, $offset);

    $count_stmt = $conn->prepare("SELECT COUNT(*) as count FROM checkup WHERE DATE(current_datetime) BETWEEN ? AND ?");
    $count_stmt->bind_param("ss", $start, $end);
} else {
    // no filter: latest 30 records
    $stmt = $conn->prepare("SELECT id, username, current_datetime FROM checkup ORDER BY current_datetime DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);

    $count_stmt = $conn->prepare("SELECT COUNT(*) as count FROM checkup");
}

$stmt->execute();
$result = $stmt->get_result();

$checkups = [];
while ($row = $result->fetch_assoc()) {
    $checkups[] = $row;
}

$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total = $count_result->fetch_assoc()['count'];

echo json_encode([
    'checkups' => $checkups,
    'total_pages' => ceil($total / $limit),
    'page' => (int)$page
]);
?>
