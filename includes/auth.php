<?php
session_start();

// Redirect unauthenticated users to login page.
if (!isset($_SESSION['user_name']) || $_SESSION['user_name'] === '') {
    header('Location: user_login.php');
    exit();
}

