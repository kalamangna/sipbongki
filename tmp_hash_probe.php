<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sipbongki;charset=utf8mb4', 'root', '');
$stmt = $pdo->prepare('SELECT email, role, password FROM users WHERE email = ?');
$emails = ['admin@sipbongki.go.id', 'test@example.com'];
$passwords = ['password','123456','admin','administrator','sipbongki','bongki','admin123','12345678'];
foreach ($emails as $email) {
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo 'USER=' . $row['email'] . ' ROLE=' . $row['role'] . PHP_EOL;
        foreach ($passwords as $pwd) {
            $ok = password_verify($pwd, $row['password']);
            echo 'TRY_PASSWORD=' . $pwd . ' OK=' . ($ok ? 'YES' : 'NO') . PHP_EOL;
        }
    }
}
