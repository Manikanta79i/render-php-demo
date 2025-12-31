<?php
require 'config.php';

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS upi_qr_requests (
            id SERIAL PRIMARY KEY,
            upi_id VARCHAR(100),
            payee_name VARCHAR(150),
            amount NUMERIC(10,2),
            ip_address VARCHAR(45),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "Table created successfully";
} catch (PDOException $e) {
    echo $e->getMessage();
}
