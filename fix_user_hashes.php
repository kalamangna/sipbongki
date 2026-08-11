<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sipbongki;charset=utf8mb4', 'root', '');
$adminHash = password_hash('password', PASSWORD_BCRYPT);
$operatorHash = password_hash('password', PASSWORD_BCRYPT);
$pdo->prepare('UPDATE users SET password = ? WHERE email = ?')->execute([$adminHash, 'admin@sipbongki.go.id']);
$pdo->prepare('UPDATE users SET password = ? WHERE email = ?')->execute([$operatorHash, 'test@example.com']);
echo "password-hashes-reset\n";
