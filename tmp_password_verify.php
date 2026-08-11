<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sipbongki;charset=utf8mb4', 'root', '');
$stmt = $pdo->prepare('SELECT email, password FROM users WHERE email = ?');
$stmt->execute(['admin@sipbongki.go.id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
    echo 'EMAIL=' . $row['email'] . PHP_EOL;
    echo 'HASH=' . $row['password'] . PHP_EOL;
    echo 'VERIFY=' . (password_verify('password', $row['password']) ? 'true' : 'false') . PHP_EOL;
} else {
    echo "NO_ADMIN_USER\n";
}
