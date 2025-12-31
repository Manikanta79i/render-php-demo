<?php
echo "<h1>🚀 PHP App Successfully Deployed on Render!</h1>";

echo "<p>Date: " . date('Y-m-d H:i:s') . "</p>";
<?php
$upi_id = "vathsi@sib";
$name   = "Vathsi Fincorp";
$amount = "1500";

$upi_url = "upi://pay?pa=$upi_id&pn=" . urlencode($name) . "&am=$amount&cu=INR";
?>

<!DOCTYPE html>
<html>
<head>
    <title>UPI Payment QR Code</title>
</head>
<body>
    <h2>Scan to Pay ₹<?php echo $amount; ?></h2>
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?php echo urlencode($upi_url); ?>" alt="UPI QR Code">
</body>
</html>
