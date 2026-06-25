<?php
$conn = new mysqli('localhost', 'root', '', 'sipstu_db');
$conn->query("ALTER TABLE puskesmas ADD COLUMN no_telp VARCHAR(20) NULL AFTER nama_puskesmas");
$conn->query("ALTER TABLE puskesmas ADD COLUMN alamat TEXT NULL AFTER no_telp");
echo "DB Updated with no_telp and alamat";
$conn->close();
