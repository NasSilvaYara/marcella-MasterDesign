<?php

session_start();

require_once __DIR__ . '/../../config/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome  = trim($_POST['nome_completo']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $senha_encriptada = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$nome, $email, $senha_encriptada])) {

        $ultimo_id = $pdo->lastInsertId();

        $_SESSION['usuario_id'] = $ultimo_id;
        $_SESSION['usuario_nome'] = $nome;

        header("Location: /../../index.php");
        exit();
    } else {
        echo "Erro ao registar.";
    }
}
?>
