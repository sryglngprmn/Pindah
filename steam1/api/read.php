<?php

//render halaman jadi json
header('Content-Type: application/json');

require '../config/app.php';

$query = select("SELECT * FROM kendaraan ORDER BY id_kendaraan DESC");

echo json_encode(['data_kendaraan' => $query]);

