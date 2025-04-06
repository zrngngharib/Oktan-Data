<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['role_id'])) {
    header("Location: ../index.php");
    exit();
}

// ئەمە بەیەکەمیە، یان یەکەم جار login بۆ ئەم کەسە؟
// وەک نموونە کۆدی login_process.php دەکەیت
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = strtolower(trim($_POST['username']));
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "<script>alert('تکایە هەموو خانەکان پڕبکەرەوە!'); window.location.href='../views/login.php';</script>";
        exit();
    }

    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['role_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_id'] = $user['id'];

        if (isset($_POST['remember_me'])) {
            setcookie('username', $username, time() + (86400 * 30), "/");
            setcookie('password', $password, time() + (86400 * 30), "/");
        }
        // تاقیکردنەوەی hashed password
        if (password_verify($password, $row['password'])) {
            // login done!
        }
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('ناوی بەکارهێنەر یان وشەی تێپەڕ هەڵەیە!'); window.location.href='login.php';</script>";
        exit();
    }
}
?>
