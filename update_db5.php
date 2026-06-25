<?php
$conn = new mysqli('localhost', 'root', '', 'sipstu_db');
$conn->query("CREATE TABLE IF NOT EXISTS balita (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    puskesmas_id INT(11) NOT NULL,
    nama_lengkap VARCHAR(150) NOT NULL,
    tgl_lahir DATE NOT NULL,
    jenis_kelamin ENUM('L','P') NOT NULL,
    id_kecamatan INT(11) NOT NULL,
    id_kelurahan INT(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
$conn->query("CREATE TABLE IF NOT EXISTS pengukuran_balita (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    balita_id INT(11) NOT NULL,
    tgl_pengukuran DATE NOT NULL,
    berat_badan DECIMAL(5,2) NOT NULL,
    tinggi_badan DECIMAL(5,2) NOT NULL,
    zscore_tbu DECIMAL(5,2) NOT NULL,
    zscore_bbu DECIMAL(5,2) NOT NULL,
    zscore_bbtb DECIMAL(5,2) NOT NULL,
    status_stunting VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (balita_id) REFERENCES balita(id) ON DELETE CASCADE
)");
echo "Balita and Pengukuran tables created successfully.";
$conn->close();
