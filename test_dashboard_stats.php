<?php
$conn = new mysqli('localhost', 'root', '', 'sipstu_db');
$m = 3; $y = 2026; $pid = 1;
$sq = "(SELECT MAX(id) FROM pengukuran_balita pb3 WHERE pb3.balita_id = balita.id AND MONTH(pb3.tgl_pengukuran) = '$m' AND YEAR(pb3.tgl_pengukuran) = '$y')";
$q = "SELECT 
                SUM(CASE WHEN pengukuran_balita.status_stunting LIKE '%sangat%' OR pengukuran_balita.status_stunting LIKE '%severe%' THEN 1 ELSE 0 END) as sangat_pendek,
                SUM(CASE WHEN (pengukuran_balita.status_stunting LIKE '%stunting%' AND pengukuran_balita.status_stunting NOT LIKE '%sangat%' AND pengukuran_balita.status_stunting NOT LIKE '%severe%') THEN 1 ELSE 0 END) as stunting,
                SUM(CASE WHEN pengukuran_balita.status_stunting LIKE '%normal%' THEN 1 ELSE 0 END) as normal
      FROM balita 
      LEFT JOIN pengukuran_balita ON pengukuran_balita.id = $sq
      WHERE balita.puskesmas_id = $pid";
$res = $conn->query($q);
if ($res) {
    print_r($res->fetch_assoc());
} else {
    echo $conn->error;
}
