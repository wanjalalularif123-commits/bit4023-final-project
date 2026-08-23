<?php
session_start();
require 'php/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($username && $email && $password) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already taken.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare("INSERT INTO users (username, password_hash, email) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $username, $hash, $email);
            $insert->execute();
            header("Location: login.php?registered=1");
            exit;
        }
    } else {
        $error = "All fields are required.";
    }
}

$pageTitle = "Register";
require 'includes/header.php';
require 'includes/register_form.php';
require 'includes/footer.php';
