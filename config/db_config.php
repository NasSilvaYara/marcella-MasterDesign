<?php

$host = "sql10.freesqldatabase.com";
$db   = "sql10828153";
$user = "sql10828153";
$pass = "rfzuwdQD6A";
$charset = "utf8mb4";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=$charset",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "Conectado com sucesso!";

} catch (PDOException $e) {

    die("Erro na conexão com o banco: " . $e->getMessage());

}

$admin_email = "golcalvesmarcella@gmail.com";
?>