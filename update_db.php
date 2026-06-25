<?php
$conn = new mysqli('localhost', 'root', '', 'sipstu_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table = "CREATE TABLE IF NOT EXISTS puskesmas (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_puskesmas VARCHAR(150) NOT NULL,
    lat VARCHAR(50) NULL,
    lng VARCHAR(50) NULL,
    user_id INT(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";
if ($conn->query($table) === TRUE) {
    echo "Table puskesmas created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
