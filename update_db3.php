<?php
$conn = new mysqli('localhost', 'root', '', 'sipstu_db');
$conn->query("ALTER TABLE puskesmas ADD COLUMN alamat TEXT NULL AFTER no_telp");
echo "DB Updated with alamat";
$conn->close();
