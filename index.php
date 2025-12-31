<?php
require 'config.php';

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upi_id = trim($_POST['upi_id']);
    $name   = trim($_POST['name']);
    $amount = trim($_POST['amount']);
    $ip     = $_SERVER['REMOTE_ADDR'];

    if ($upi_id && $name && $amount) {
        $stmt = $pdo->prepare(
            "INSERT INTO upi_qr_requests (upi_id, payee_name, amount, ip_address)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$upi_id, $name, $amount, $ip]);
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>UPI QR Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-700 flex items-center justify-center p-6">

<div class="bg-black/80 rounded-2xl shadow-2xl w-full max-w-4xl p-8">

    <h2 class="text-center text-2xl font-bold text-cyan-400 mb-8">
        💳 UPI QR Generator
    </h2>

    <?php if ($success): ?>
        <div class="bg-green-900/40 text-green-400 p-3 rounded-xl mb-6 text-center">
            Data saved successfully ✔
        </div>
    <?php endif; ?>

    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- LEFT FORM -->
        <div>
            <label class="text-gray-300 text-sm">UPI ID</label>
            <input name="upi_id" id="upi" required
                   class="w-full mb-4 px-4 py-3 rounded-xl bg-gray-900 text-white">

            <label class="text-gray-300 text-sm">Payee Name</label>
            <input name="name" id="name" required
                   class="w-full mb-4 px-4 py-3 rounded-xl bg-gray-900 text-white">

            <label class="text-gray-300 text-sm">Amount (₹)</label>
            <input name="amount" id="amount" required type="number"
                   class="w-full mb-6 px-4 py-3 rounded-xl bg-gray-900 text-white">

            <button type="submit"
                    class="w-full bg-cyan-400 text-black py-3 rounded-xl font-semibold hover:bg-cyan-300 transition">
                Save & Generate QR
            </button>
        </div>

        <!-- RIGHT QR -->
        <div class="flex flex-col items-center justify-center">
            <div id="qrBox" class="hidden text-center">
                <p id="amountText" class="text-green-400 font-semibold mb-3"></p>
                <img id="qrImage" class="bg-white p-4 rounded-xl w-64 h-64">
            </div>
            <p id="placeholder" class="text-gray-500 text-sm">
                Enter details to preview QR
            </p>
        </div>

    </form>

    <p class="text-center text-xs text-gray-500 mt-8">
        IP address is automatically recorded
    </p>

</div>

<script>
    const upi = document.getElementById('upi');
    const nameField = document.getElementById('name');
    const amount = document.getElementById('amount');
    const qrImage = document.getElementById('qrImage');
    const qrBox = document.getElementById('qrBox');
    const amountText = document.getElementById('amountText');
    const placeholder = document.getElementById('placeholder');

    function updateQR() {
        if (upi.value && nameField.value && amount.value) {
            const upiUrl = `upi://pay?pa=${upi.value}&pn=${encodeURIComponent(nameField.value)}&am=${amount.value}&cu=INR`;
            qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(upiUrl)}`;
            amountText.textContent = `Scan to Pay ₹${amount.value}`;
            qrBox.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
    }

    upi.addEventListener('input', updateQR);
    nameField.addEventListener('input', updateQR);
    amount.addEventListener('input', updateQR);
</script>

</body>
</html>
