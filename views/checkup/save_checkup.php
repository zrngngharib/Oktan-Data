<?php
session_start();
include '../../includes/db.php'; // ڕێڕەویەکە گۆڕە بەپێی پڕۆژەکەت

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ دڵنیا ببەوە کە بەکارهێنەرەکە چووە ژوورەوە
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// ✅ فەرمی POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 🔸 زانیاریەکانی بەکارهێنەر لە سێشن
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $current_datetime = date('Y-m-d H:i:s');

    // ✅ وەرگرتنی هەموو داتاکانی POST ـەکە بە فێڵەری ئەمنی
    $params = [];
    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            $params[$key] = array_map('htmlspecialchars', $value);
        } else {
            $params[$key] = trim(htmlspecialchars($value));
        }
    }

    // ✅ بارکردنی وێنەکان (ئەگەر هەیە)
    if (!empty($params['images'])) {
        // Filter out empty strings and invalid entries
        $filtered_images = array_filter($params['images'], function($image) {
            return !empty($image) && filter_var($image, FILTER_VALIDATE_URL); // Validate URLs
        });
        // Ensure the JSON array is not empty
        $files_json = !empty($filtered_images) ? json_encode(array_values($filtered_images), JSON_UNESCAPED_SLASHES) : null;
    } else {
        $files_json = null; // Handle the case where no images are provided
    }

    // ✅ ئامادەکردنی کۆدی SQL و Bind
    $sql = "INSERT INTO checkup (
        user_id, gen1_load, gen1_temp, gen1_op_bar, gen1_fp_bar, gen1_hours,
        gen2_load, gen2_temp, gen2_op_bar, gen2_fp_bar, gen2_hours,
        gen3_load, gen3_temp, gen3_op_bar, gen3_fp_bar, gen3_hours,
        gen4_load, gen4_temp, gen4_op_bar, gen4_fp_bar, gen4_hours,
        fuel_gas, fuel_lpg, ats_load, ats_temp, ats_kw,
        oxygen_compressor_bar, oxygen_temp, oxygen_hours, oxygen_quality, oxygen_dryer,
        o2_right, o2_left, o2_out,
        boiler1, boiler2, burner1, burner2, softener,
        ro_right, ro_left, blood_status,
        dynamo1_status, dynamo2_status,
        chiller1_in, chiller1_out, chiller2_in, chiller2_out,
        chiller3_in, chiller3_out, chiller4_in, chiller4_out,
        water_treatment_status, chlor_status, park_globe_status, pool_status,
        vacuum, vacuum_power, vacuum_temp, vacuum_oil,
        surgery_comp_right_power, surgery_comp_right_temp,
        surgery_comp_left_power, surgery_comp_left_temp,
        teeth_comp_right_power, teeth_comp_right_temp,
        teeth_comp_left_power, teeth_comp_left_temp,
        tank1_percentage, tank2_percentage, tank3_percentage,
        taqim_right_status, taqim_left_status, lab_right_status, lab_left_status,
        elevator_service_status, elevator_surgery_status,
        elevator_forward_right_status, elevator_forward_left_status,
        elevator_lab_status, elevator_noringa_status,
        ups_b_load, ups_b_temp, ups_b_split,
        ups_g_load, ups_g_temp, ups_g_split,
        dafia_b, dafia_g, dafia_1, dafia_2, dafia_3, dafia_4, dafia_norenga,
        server_split, server_temp, server_network, server_badala, server_camera, server_fire_system,
        username, current_datetime, files, note
    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    // ✅ ئامادەکردنی statement
    $stmt = mysqli_prepare($db, $sql);

    if (!$stmt) {
        die("❌ Prepare failed: " . mysqli_error($db));
    }

    // ✅ Types + Values
    $types = str_repeat("i", 22) . // Numbers first
             str_repeat("i", 5) . 
             str_repeat("i", 8) . 
             str_repeat("s", 2) . 
             str_repeat("i", 3) . 
             str_repeat("i", 4) . 
             str_repeat("s", 3) . 
             str_repeat("i", 8) . 
             str_repeat("s", 4) . 
             str_repeat("i", 4) . 
             str_repeat("i", 4) . 
             str_repeat("i", 4) . 
             str_repeat("s", 4) . 
             str_repeat("s", 6) . 
             str_repeat("i", 2) . 
             str_repeat("s", 2) . 
             str_repeat("s", 4) . 
             str_repeat("s", 6) . 
             str_repeat("s", 5) . 
             "s" . // username
             "s" . // current_datetime
             "s" . // files_json
             "s";  // note

    // ✅ Bind Params (be careful about the number of items!)
    mysqli_stmt_bind_param($stmt, $types,
        $user_id,
        $params['gen1_load'], $params['gen1_temp'], $params['gen1_op_bar'], $params['gen1_fp_bar'], $params['gen1_hours'],
        $params['gen2_load'], $params['gen2_temp'], $params['gen2_op_bar'], $params['gen2_fp_bar'], $params['gen2_hours'],
        $params['gen3_load'], $params['gen3_temp'], $params['gen3_op_bar'], $params['gen3_fp_bar'], $params['gen3_hours'],
        $params['gen4_load'], $params['gen4_temp'], $params['gen4_op_bar'], $params['gen4_fp_bar'], $params['gen4_hours'],
        $params['fuel_gas'], $params['fuel_lpg'], $params['ats_load'], $params['ats_temp'], $params['ats_kw'],
        $params['oxygen_compressor_bar'], $params['oxygen_temp'], $params['oxygen_hours'], $params['oxygen_quality'], $params['oxygen_dryer'],
        $params['o2_right'], $params['o2_left'], $params['o2_out'],
        $params['boiler1'], $params['boiler2'], $params['burner1'], $params['burner2'], $params['softener'],
        $params['ro_right'], $params['ro_left'], $params['blood_status'],
        $params['dynamo1_status'], $params['dynamo2_status'],
        $params['chiller1_in'], $params['chiller1_out'], $params['chiller2_in'], $params['chiller2_out'],
        $params['chiller3_in'], $params['chiller3_out'], $params['chiller4_in'], $params['chiller4_out'],
        $params['water_treatment_status'], $params['chlor_status'], $params['park_globe_status'], $params['pool_status'],
        $params['vacuum'], $params['vacuum_power'], $params['vacuum_temp'], $params['vacuum_oil'],
        $params['surgery_comp_right_power'], $params['surgery_comp_right_temp'],
        $params['surgery_comp_left_power'], $params['surgery_comp_left_temp'],
        $params['teeth_comp_right_power'], $params['teeth_comp_right_temp'],
        $params['teeth_comp_left_power'], $params['teeth_comp_left_temp'],
        $params['tank1_percentage'], $params['tank2_percentage'], $params['tank3_percentage'],
        $params['taqim_right_status'], $params['taqim_left_status'], $params['lab_right_status'], $params['lab_left_status'],
        $params['elevator_service_status'], $params['elevator_surgery_status'],
        $params['elevator_forward_right_status'], $params['elevator_forward_left_status'],
        $params['elevator_lab_status'], $params['elevator_noringa_status'],
        $params['ups_b_load'], $params['ups_b_temp'], $params['ups_b_split'],
        $params['ups_g_load'], $params['ups_g_temp'], $params['ups_g_split'],
        $params['dafia_b'], $params['dafia_g'], $params['dafia_1'], $params['dafia_2'], $params['dafia_3'], $params['dafia_4'], $params['dafia_norenga'],
        $params['server_split'], $params['server_temp'], $params['server_network'], $params['server_badala'], $params['server_camera'], $params['server_fire_system'],
        $username, $current_datetime, $files_json, $params['note']
    );

    if (mysqli_stmt_execute($stmt)) {

        echo '<!DOCTYPE html>
        <html lang="ku" dir="rtl">
        <head>
            <meta charset="UTF-8">
            <title>پەیامی سەرکەوتن</title>
            <style>
                @keyframes popup {
                    0% { transform: scale(0.5); opacity: 0; }
                    60% { transform: scale(1.05); opacity: 1; }
                    100% { transform: scale(1); }
                }
    
                body {
                    margin: 0;
                    font-family: "Zain", sans-serif;
                    background-color: rgba(0, 0, 0, 0.6);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
    
                .popup-container {
                    background: white;
                    padding: 30px 40px;
                    border-radius: 16px;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
                    text-align: center;
                    animation: popup 0.5s ease-out;
                    position: relative;
                }
    
                .popup-container h2 {
                    color: #22C55E;
                    font-size: 24px;
                    margin-bottom: 15px;
                }
    
                .popup-container p {
                    color: #333;
                    font-size: 18px;
                    margin-bottom: 10px;
                }
    
                .loader {
                    border: 4px solid #f3f3f3;
                    border-top: 4px solid #4F46E5;
                    border-radius: 50%;
                    width: 40px;
                    height: 40px;
                    animation: spin 1s linear infinite;
                    margin: 0 auto;
                }
    
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
    
            </style>
        </head>
        <body>
    
            <div class="popup-container">
                <h2>✅ پشکنینی ڕۆژانە بە سەرکەوتووی زیادکرا!</h2>
                <p>گەڕانەوە بۆ لاپەڕەی سەرەكی ...</p>
                <div class="loader"></div>
            </div>
    
            <script>
                setTimeout(function() {
                    window.location.href = "../daily_check.php";
                }, 2000);
            </script>
    
        </body>
        </html>';
        
    } else {
    
        echo '<!DOCTYPE html>
        <html lang="ku" dir="rtl">
        <head>
            <meta charset="UTF-8">
            <title>هەڵە لە تۆمارکردن</title>
            <style>
                @keyframes popup {
                    0% { transform: scale(0.5); opacity: 0; }
                    60% { transform: scale(1.05); opacity: 1; }
                    100% { transform: scale(1); }
                }
    
                body {
                    margin: 0;
                    font-family: "Zain", sans-serif;
                    background-color: rgba(0, 0, 0, 0.6);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
    
                .popup-container {
                    background: white;
                    padding: 30px 40px;
                    border-radius: 16px;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
                    text-align: center;
                    animation: popup 0.5s ease-out;
                    position: relative;
                }
    
                .popup-container h2 {
                    color: #EF4444;
                    font-size: 24px;
                    margin-bottom: 15px;
                }
    
                .popup-container p {
                    color: #333;
                    font-size: 18px;
                    margin-bottom: 10px;
                }
            </style>
        </head>
        <body>
    
            <div class="popup-container">
                <h2>❌ هەڵە لە کاتی تۆمارکردن!</h2>
                <p>" . mysqli_stmt_error($stmt) . "</p>
            </div>
    
            <script>
                setTimeout(function() {
                    window.location.href = "../daily_check.php";
                }, 5000);
            </script>
    
        </body>
        </html>';
    }
}    
?>