<?php
$conn = new mysqli('localhost', 'root', '');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS sipstu_db");
$conn->select_db("sipstu_db");

$table = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('superadmin', 'admin_puskesmas') NOT NULL
)";
$conn->query($table);

$pass_super = password_hash('super', PASSWORD_DEFAULT);
$pass_admin = password_hash('admin', PASSWORD_DEFAULT);

$conn->query("TRUNCATE TABLE users");
$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $u, $p, $r);

$u = 'superadmin123'; $p = $pass_super; $r = 'superadmin'; $stmt->execute();
$u = 'admin123';      $p = $pass_admin; $r = 'admin_puskesmas'; $stmt->execute();

echo "Database setup completed.\n";
