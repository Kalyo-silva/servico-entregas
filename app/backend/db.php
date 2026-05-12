<?php

$host = "postgres";
$db = "delivery_db";
$user = "postgres";
$password = "postgres";

try {
    $pdo = new PDO(
        "pgsql:host=$host;dbname=$db",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
