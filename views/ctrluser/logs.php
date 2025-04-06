<?php
include_once('../../includes/db.php');
session_start();


// Get the client IP address
function get_client_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Admin access only
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role_query = "SELECT role_id FROM users WHERE id = $user_id";
$role_result = mysqli_query($conn, $role_query);
$role_row = mysqli_fetch_assoc($role_result);

if ($role_row['role_id'] != 1) {
    header("Location: ../login.php");
    exit();
}

// Define the number of records per page
$records_per_page = 50;

// Get the current page number from the query string, default to 1
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $records_per_page;

// Build query with filters
$where = "WHERE 1=1";
if (!empty($_GET['username'])) {
    $username = mysqli_real_escape_string($conn, $_GET['username']);
    $where .= " AND user_id IN (SELECT id FROM users WHERE username LIKE '%$username%')";
}

// Count total records for pagination
$count_query = "SELECT COUNT(*) AS total_records FROM user_activity_log $where";
$count_result = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc($count_result);
$total_records = $count_row['total_records'];

// Calculate total pages
$total_pages = ceil($total_records / $records_per_page);

// Fetch the logs with limit and offset
$log_query = "SELECT * FROM user_activity_log $where ORDER BY created_at DESC LIMIT $records_per_page OFFSET $offset";
$log_result = mysqli_query($conn, $log_query);
?>

<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تۆمارەکان - O_Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @font-face {
            font-family: 'Zain';
            src: url('../../fonts/Zain.ttf') format('truetype');
        }
        body {
            font-family: 'Zain', sans-serif;
            background-color: #dee8ff;
            background-image: linear-gradient(135deg, #dee8ff, #f5f7fa);
        }
        .glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 2rem;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
            padding: 2rem;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="glass max-w-3xl w-full animate-fade-in space-y-6">

        <div class="text-center">
            <h1 class="text-3xl font-bold text-indigo-700 animate-pulse">چالایەكانی بەكارهێنەران</h1>
            <p class="text-sm mt-2 text-gray-700">لیستی هەموو چالاکیەکان</p>
        </div>

        <div class="text-center mb-4">
            <form method="GET" class="d-inline-flex gap-2">
                <input type="text" name="username" class="form-control" placeholder="ناوی بەکارهێنەر">
                <button type="submit" class="btn btn-primary">فیلترکردن</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped text-center align-middle bg-white rounded shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>ناوی بەکارهێنەر</th>
                        <th>چالاکی</th>
                        <th>IP</th>
                        <th>کاتی چوونەژوورەوە</th>
                        <th>کاتی دەرچوون</th>
                        <th>کات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = $offset + 1;
                    while ($log = mysqli_fetch_assoc($log_result)) {
                        // Get username
                        $log_user_id = $log['user_id'];
                        $username_query = mysqli_query($conn, "SELECT username FROM users WHERE id = $log_user_id");
                        $username_row = mysqli_fetch_assoc($username_query);
                        $username = $username_row['username'];

                        // Display log details
                        echo "<tr>";
                        echo "<td>".$counter++."</td>";
                        echo "<td>".htmlspecialchars($username)."</td>";
                        echo "<td>".htmlspecialchars($log['action'])."</td>";
                        echo "<td>".$log['ip_address']."</td>";
                        echo "<td>".($log['login_time'] ? $log['login_time'] : 'N/A')."</td>";
                        echo "<td>".($log['logout_time'] ? $log['logout_time'] : 'N/A')."</td>";
                        echo "<td>".$log['created_at']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($current_page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $current_page - 1; ?>&username=<?php echo htmlspecialchars($_GET['username'] ?? ''); ?>">پێشوو</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo $i == $current_page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>&username=<?php echo htmlspecialchars($_GET['username'] ?? ''); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($current_page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&username=<?php echo htmlspecialchars($_GET['username'] ?? ''); ?>">دواتر</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <div class="text-center mt-4 flex justify-center gap-2">
            <a href="users.php" class="btn btn-secondary rounded-pill">⬅️ گەڕانەوە بۆ بەکارهێنەران</a>
        </div>

    </div>

</body>
</html>