<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Live UPI QR Generator</title>
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
            border-radius: 18px;
            padding: 30px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 45px rgba(0,0,0,0.6);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #00e5ff;
        }

        label {
            font-size: 14px;
            opacity: 0.85;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            margin-bottom: 18px;
            border-radius: 10px;
            border: none;
            outline: none;
            background: #1f1f1f;
            color: #fff;
            font-size: 15px;
        }

        .qr-box {
            margin-top: 20px;
            text-align: center;
            display: none;
        }

        .qr-box img {
            background: #fff;
            padding: 12px;
            border-radius: 14px;
            width: 260px;
            height: 260px;
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
            margin-top: 22px;
            opacity: 0.5;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>💳 Live UPI QR Generator</h2>

    <label>UPI ID</label>
    <input type="text" id="upi_id" placeholder="example@upi">

    <label>Payee Name</label>
    <input type="text" id="name" placeholder="Your Name / Business">

    <label>Amount (₹)</label>
    <input type="number" id="amount" placeholder="Enter amount">

    <div class="qr-box" id="qrBox">
        <p class="amount" id="amountText"></p>
        <img id="qrImage" src="" alt="UPI QR Code">
    </div>

    <footer>
        Updates instantly • Powered by PHP + JS • Hosted on Render
    </footer>
</div>

<script>
    const upiInput = document.getElementById('upi_id');
    const nameInput = document.getElementById('name');
    const amountInput = document.getElementById('amount');
    const qrImage = document.getElementById('qrImage');
    const qrBox = document.getElementById('qrBox');
    const amountText = document.getElementById('amountText');

    function updateQR() {
        const upi = upiInput.value.trim();
        const name = nameInput.value.trim();
        const amount = amountInput.value.trim();

        if (upi && name && amount) {
            const upiUrl = `upi://pay?pa=${upi}&pn=${encodeURIComponent(name)}&am=${amount}&cu=INR`;
            qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=280x280&data=${encodeURIComponent(upiUrl)}`;
            amountText.textContent = `Scan to Pay ₹${amount}`;
            qrBox.style.display = 'block';
        } else {
            qrBox.style.display = 'none';
        }
    }

    upiInput.addEventListener('input', updateQR);
    nameInput.addEventListener('input', updateQR);
    amountInput.addEventListener('input', updateQR);
</script>

</body>
</html>
