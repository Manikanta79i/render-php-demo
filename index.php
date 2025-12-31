<?php
$upi_id = $_POST['upi_id'] ?? '';
$name   = $_POST['name'] ?? '';
$amount = $_POST['amount'] ?? '';

$upi_url = '';
if ($upi_id && $name && $amount) {
    $upi_url = "upi://pay?pa=$upi_id&pn=" . urlencode($name) . "&am=$amount&cu=INR";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UPI QR Code Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .card {
            background: #111;
            border-radius: 16px;
            padding: 30px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #00e5ff;
        }

        label {
            font-size: 14px;
            opacity: 0.8;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            margin-bottom: 16px;
            border-radius: 10px;
            border: none;
            outline: none;
            background: #1f1f1f;
            color: #fff;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #00e5ff, #00bcd4);
            color: #000;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,229,255,0.4);
        }

        .qr-box {
            margin-top: 25px;
            text-align: center;
        }

        .qr-box img {
            background: #fff;
            padding: 12px;
            border-radius: 12px;
        }

        .amount {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #00e676;
        }

        footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            opacity: 0.5;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>💳 UPI QR Generator</h2>

    <form method="POST">
        <label>UPI ID</label>
        <input type="text" name="upi_id" placeholder="example@upi" required value="<?= htmlspecialchars($upi_id) ?>">

        <label>Payee Name</label>
        <input type="text" name="name" placeholder="Your Name / Business" required value="<?= htmlspecialchars($name) ?>">

        <label>Amount (₹)</label>
        <input type="number" name="amount" placeholder="Enter amount" required value="<?= htmlspecialchars($amount) ?>">

        <button type="submit">Generate QR Code</button>
    </form>

    <?php if ($upi_url): ?>
        <div class="qr-box">
            <p class="amount">Scan to Pay ₹<?= htmlspecialchars($amount) ?></p>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=280x280&data=<?= urlencode($upi_url) ?>" alt="UPI QR Code">
        </div>
    <?php endif; ?>

    <footer>
        Powered by PHP • Hosted on Render
    </footer>
</div>

</body>
</html>
