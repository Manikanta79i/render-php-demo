<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UPI QR Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700 flex items-center justify-center p-6">

<div class="bg-black/80 rounded-2xl shadow-2xl w-full max-w-4xl p-8">
    <h2 class="text-center text-2xl font-bold text-cyan-400 mb-8">
        💳 UPI QR Generator
    </h2>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- LEFT: FORM -->
        <div>
            <label class="block text-sm text-gray-300 mb-1">UPI ID</label>
            <input id="upi" type="text" placeholder="example@upi"
                class="w-full mb-4 px-4 py-3 rounded-xl bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">

            <label class="block text-sm text-gray-300 mb-1">Payee Name</label>
            <input id="name" type="text" placeholder="Your Name / Business"
                class="w-full mb-4 px-4 py-3 rounded-xl bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">

            <label class="block text-sm text-gray-300 mb-1">Amount (₹)</label>
            <input id="amount" type="number" placeholder="Enter amount"
                class="w-full px-4 py-3 rounded-xl bg-gray-900 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <!-- RIGHT: QR -->
        <div class="flex flex-col items-center justify-center">
            <div id="qrBox" class="hidden text-center">
                <p id="amountText" class="text-lg font-semibold text-green-400 mb-3"></p>
                <img id="qrImage" class="bg-white p-4 rounded-xl shadow-lg w-64 h-64">
            </div>

            <p id="placeholder" class="text-gray-500 text-sm text-center">
                Enter details to generate QR code
            </p>
        </div>
    </div>

    <p class="text-center text-xs text-gray-500 mt-8">
        Powered by PHP • Tailwind CSS • Hosted on Render
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
        const u = upi.value.trim();
        const n = nameField.value.trim();
        const a = amount.value.trim();

        if (u && n && a) {
            const upiUrl = `upi://pay?pa=${u}&pn=${encodeURIComponent(n)}&am=${a}&cu=INR`;
            qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(upiUrl)}`;
            amountText.textContent = `Scan to Pay ₹${a}`;
            qrBox.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            qrBox.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }

    upi.addEventListener('input', updateQR);
    nameField.addEventListener('input', updateQR);
    amount.addEventListener('input', updateQR);
</script>

</body>
</html>
