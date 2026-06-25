<?php
$conn = new mysqli('localhost', 'root', '', 'sipstu_db');
$conn->query("CREATE TABLE IF NOT EXISTS kecamatan (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_kecamatan VARCHAR(100) NOT NULL
)");
$conn->query("CREATE TABLE IF NOT EXISTS kelurahan (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_kecamatan INT(11) NOT NULL,
    nama_kelurahan VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_kecamatan) REFERENCES kecamatan(id) ON DELETE CASCADE
)");
echo "Kecamatan and Kelurahan tables created successfully.";
$conn->close();
