<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sipbongki;charset=utf8mb4', 'root', '');
$tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
foreach ($tables as $table) {
    if (stripos($table, 'session') !== false || stripos($table, 'users') !== false) {
        echo $table . PHP_EOL;
    }
}
