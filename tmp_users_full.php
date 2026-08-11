<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sipbongki;charset=utf8mb4', 'root', '');
$stmt = $pdo->query('SELECT id, name, email, role, password FROM users');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['id'] . ' | ' . $row['name'] . ' | ' . $row['email'] . ' | ' . $row['role'] . ' | ' . $row['password'] . PHP_EOL;
}
