<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM upi_qr_requests ORDER BY created_at DESC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Inserted Records</h2>";
echo "<pre>";
print_r($rows);
echo "</pre>";
