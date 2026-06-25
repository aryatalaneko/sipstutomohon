<?php
$conn = new mysqli('localhost', 'root', '', 'sipstu_db');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$coords = [
    'Kelurahan Kakaskasen'    => ['1.3310', '124.8190'],
    'Kelurahan Lansot'        => ['1.2990', '124.8350'],
    'Kelurahan Tumatangtang'  => ['1.2965', '124.8375'],
    'Kelurahan Matani Satu'   => ['1.3165', '124.8365'],
    'Kelurahan Matani Dua'    => ['1.3148', '124.8388'],
    'Kelurahan Taratara'      => ['1.3275', '124.7995'],
];

$updated = 0;
$stmt = $conn->prepare("UPDATE kelurahan SET lat = ?, lng = ? WHERE nama_kelurahan = ?");
foreach ($coords as $nama => $c) {
    $stmt->bind_param("sss", $c[0], $c[1], $nama);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $updated++;
        echo "Updated: $nama => ({$c[0]}, {$c[1]})\n";
    } else {
        echo "NOT FOUND: $nama\n";
    }
}

echo "\nDone! Updated $updated kelurahan.\n";
$conn->close();
