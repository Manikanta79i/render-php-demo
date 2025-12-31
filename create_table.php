<?php
require 'config.php';

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS upi_qr_requests (
            id SERIAL PRIMARY KEY,
            upi_id VARCHAR(100) NOT NULL,
            payee_name VARCHAR(150) NOT NULL,
            amount NUMERIC(10,2) NOT NULL,
            ip_address VARCHAR(45) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo '✅ Table created successfully';
} catch (PDOException $e) {
    echo $e->getMessage();
}
