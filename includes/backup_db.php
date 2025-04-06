<?php
session_start(); // Start the session

error_reporting(E_ALL);
ini_set('display_errors', 1);

// زانیاریەکانی داتابەیس
$dbHost = "localhost"; // ڕێچکەی ڕاژە
$dbUser = "root";      // ناوی بەکارهێنەر
$dbPass = "";          // وشەی نهێنی (بەتاڵ بێت ئەگەر نەبووە)
$dbName = "o_data";    // ناوی داتابەیسەکەت

// ڕێچکەی فۆڵدەرەکە
$backupFolder = '../includes/backup_db/';
if (!is_dir($backupFolder)) {
    mkdir($backupFolder, 0777, true);
}

// ✅ Optional: Check role in DB (Extra security)
$user_id = $_SESSION['user_id']; // Get the logged-in user's ID from the session
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName); // Connect to the database
$query = "SELECT role_id FROM users WHERE id = $user_id"; // Query to fetch the user's role
$result = mysqli_query($conn, $query); // Execute the query
$user = mysqli_fetch_assoc($result); // Fetch the result as an associative array

// ئەگەر یوزەر ئەدمین نەبوو ئەم لاپەڕەیە نەبینێت 
if (!$user || $user['role_id'] !== '1') { // Check if the user is not found or not an admin
    header("Location: ../views/dashboard.php"); // Redirect to the dashboard
    exit(); // Stop further execution
}

function backupDatabase() {
    global $dbHost, $dbUser, $dbPass, $dbName, $backupFolder;

    // بەروار و کات بۆ ناوی فایلی بکۆپی کراو
    $date = date('d.m.Y.h.i.a');
    $backupFile = $backupFolder . $date . '.sql';

    // کۆدی بکۆپکردن بە بەکارهێنانی mysqldump
    $command = "C:\\xampp\\mysql\\bin\\mysqldump --user=$dbUser --password=$dbPass --host=$dbHost $dbName > $backupFile";

    // فرمانەکە جێبەجێ بکە
    exec($command, $output, $returnVar);
    return $returnVar === 0 ? $backupFile : false;
}

$backupFile = backupDatabase();
$success = $backupFile !== false;
?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>باك ئەپ كردنی داتابەیس</title>

    <!-- TailwindCSS + Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        @font-face {
            font-family: 'Zain';
            src: url('../fonts/Zain.ttf') format('truetype');
        }

        body {
            font-family: 'Zain', Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .popup {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .popup h1 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .popup p {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .popup button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .popup button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="popup">
        <?php if ($success): ?>
            <h1>سەركەوتوبوو!</h1>
            <p>باكئەكردنەكە سەركەوتوبوو: <?php echo htmlspecialchars($backupFile); ?></p>
        <?php else: ?>
            <h1>شكستی هێنا!</h1>
            <p>Failed to create backup. Error: <?php echo htmlspecialchars(implode("\n", $output)); ?></p>
        <?php endif; ?>
        <button onclick="redirectToDashboard()">بگەڕێوە بۆ سەرەتا</button>
    </div>

    <script>
        function redirectToDashboard() {
            window.location.href = "../views/dashboard.php";
        }

        // گەڕاندنەوە خۆکارانە دوای 5 چرکە
        setTimeout(() => {
            window.location.href = "../views/dashboard.php";
        }, 5000);
    </script>
</body>
</html>