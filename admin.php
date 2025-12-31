<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM upi_qr_requests ORDER BY created_at DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin – UPI Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6">

<h2 class="text-xl mb-4">UPI QR Requests</h2>

<table class="w-full text-sm border border-gray-700">
    <tr class="bg-gray-800">
        <th class="p-2">ID</th>
        <th class="p-2">UPI</th>
        <th class="p-2">Name</th>
        <th class="p-2">Amount</th>
        <th class="p-2">IP</th>
        <th class="p-2">Date</th>
    </tr>

    <?php foreach ($data as $row): ?>
    <tr class="border-t border-gray-700">
        <td class="p-2"><?= $row['id'] ?></td>
        <td class="p-2"><?= htmlspecialchars($row['upi_id']) ?></td>
        <td class="p-2"><?= htmlspecialchars($row['payee_name']) ?></td>
        <td class="p-2">₹<?= $row['amount'] ?></td>
        <td class="p-2"><?= $row['ip_address'] ?></td>
        <td class="p-2"><?= $row['created_at'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
