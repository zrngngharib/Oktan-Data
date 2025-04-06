<?php
include '../../includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("❌ ID not provided.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission for editing
    $fields = array_map('htmlspecialchars', $_POST);
    $sql = "UPDATE checkup SET 
        gen1_load = ?, gen1_temp = ?, gen1_op_bar = ?, gen1_fp_bar = ?, gen1_hours = ?,
        gen2_load = ?, gen2_temp = ?, gen2_op_bar = ?, gen2_fp_bar = ?, gen2_hours = ?,
        gen3_load = ?, gen3_temp = ?, gen3_op_bar = ?, gen3_fp_bar = ?, gen3_hours = ?,
        gen4_load = ?, gen4_temp = ?, gen4_op_bar = ?, gen4_fp_bar = ?, gen4_hours = ?,
        fuel_gas = ?, fuel_lpg = ?, ats_load = ?, ats_temp = ?, ats_kw = ?,
        oxygen_compressor_bar = ?, oxygen_temp = ?, oxygen_hours = ?, oxygen_quality = ?, oxygen_dryer = ?,
        o2_right = ?, o2_left = ?, o2_out = ?,
        boiler1 = ?, boiler2 = ?, burner1 = ?, burner2 = ?, softener = ?,
        ro_right = ?, ro_left = ?, blood_status = ?,
        dynamo1_status = ?, dynamo2_status = ?,
        chiller1_in = ?, chiller1_out = ?, chiller2_in = ?, chiller2_out = ?,
        chiller3_in = ?, chiller3_out = ?, chiller4_in = ?, chiller4_out = ?,
        water_treatment_status = ?, chlor_status = ?, park_globe_status = ?, pool_status = ?,
        vacuum = ?, vacuum_power = ?, vacuum_temp = ?, vacuum_oil = ?,
        surgery_comp_right_power = ?, surgery_comp_right_temp = ?,
        surgery_comp_left_power = ?, surgery_comp_left_temp = ?,
        teeth_comp_right_power = ?, teeth_comp_right_temp = ?,
        teeth_comp_left_power = ?, teeth_comp_left_temp = ?,
        tank1_percentage = ?, tank2_percentage = ?, tank3_percentage = ?,
        taqim_right_status = ?, taqim_left_status = ?, lab_right_status = ?, lab_left_status = ?,
        elevator_service_status = ?, elevator_surgery_status = ?,
        elevator_forward_right_status = ?, elevator_forward_left_status = ?,
        elevator_lab_status = ?, elevator_noringa_status = ?,
        ups_b_load = ?, ups_b_temp = ?, ups_b_split = ?,
        ups_g_load = ?, ups_g_temp = ?, ups_g_split = ?,
        dafia_b = ?, dafia_g = ?, dafia_1 = ?, dafia_2 = ?, dafia_3 = ?, dafia_4 = ?, dafia_norenga = ?,
        server_split = ?, server_temp = ?, server_network = ?, server_badala = ?, server_camera = ?, server_fire_system = ?,
        note = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        str_repeat("s", 90) . "i", // 90 string fields + 1 integer for ID
        ...array_values($fields), $id
    );

    if ($stmt->execute()) {
        echo "✅ Checkup updated successfully.";
    } else {
        echo "❌ Error updating checkup: " . $stmt->error;
    }
    exit();
}

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM checkup WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>دەستكاری پشکنین</title>
</head>
<body>
    <form method="POST">
        <?php foreach ($data as $field => $value): ?>
            <label><?= htmlspecialchars($field) ?>:</label>
            <input type="text" name="<?= htmlspecialchars($field) ?>" value="<?= htmlspecialchars($value) ?>" required>
        <?php endforeach; ?>
        <button type="submit">نوێکردنەوە</button>
    </form>
</body>
</html>
