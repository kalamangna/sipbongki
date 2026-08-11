<?php

$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sipbongki;charset=utf8mb4', 'root', '');
$stmt = $pdo->query('SELECT email, role FROM users');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['email'] . ' | ' . $row['role'] . PHP_EOL;
}
