<?php
session_start();
include '../includes/db.php'; // ڕێڕەویەکە گۆڕە بۆ پڕۆژەکەت
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>📝 پشکنینی ڕۆژانە</title>
    
    <!-- Bootstrap RTL + TailwindCSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @font-face {
            font-family: 'Zain';
            src: url('../fonts/Zain.ttf');
        }

        body {
            font-family: 'Zain', sans-serif;
            background: linear-gradient(135deg, #dee8ff, #f5f7fa);
            min-height: 100vh;
        }

        .glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            border-radius: 1rem;
            box-shadow: 0 12px 32px rgba(31, 38, 135, 0.1);
        }

        .main-title {
            font-size: 2.2rem;
            font-weight: bold;
            color: #4F46E5;
        }

        .action-btn {
            background-color: #4F46E5;
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 10rem;
            font-size: 1.2rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .action-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px #4f46e5;
        }

        .action-btn-green {
            background-color: #10B981;
        }

        .action-btn-yellow {
            background-color: #4f46e5;
        }

        .action-btn-red {
            background-color: #4f46e5;
        }

        .icon {
            font-size: 1.5rem;
            margin-left: 0.5rem;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .footer {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.9rem;
            color: #aaa;
        }

    </style>
</head>

<body class="flex flex-col justify-center items-center p-4">

    <!-- Header -->
    <div class="glass max-w-4xl w-full p-8 flex flex-col items-center mt-10">
        <h1 class="main-title mb-6">📝 پشکنینی ڕۆژانە</h1>

        <!-- Action Buttons -->
        <div class="btn-group">
            <!-- خانە -->
            <a href="dashboard.php" class="action-btn action-btn-blue">
                <i class="fas fa-home icon"></i> سەرەتا
            </a>

            <!-- تۆمارکردن -->
            <a href="checkup/add_checkup.php" class="action-btn action-btn-green">
                <i class="fas fa-plus icon"></i> تۆمارکردن
            </a>

            <!-- بینین -->
            <a href="checkup/view_checkup.php" class="action-btn action-btn-yellow">
                <i class="fas fa-eye icon"></i> بینینی پشکنینەکان
            </a>
        </div>

        <!-- Extra Description -->
        <p class="mt-8 text-gray-600 text-center">
            💡 لێرە دەتوانیت پشکنینی ڕۆژانە زیاد بکەیت، ڕاپۆرتەکان ببینیت و چاپیان بكەیت .
        </p>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-12 text-gray-600 text-sm">
        &copy; <?= date('Y'); ?> O_Data - هەموو مافەکان پارێزراون
    </footer>

    <!-- FontAwesome for Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>