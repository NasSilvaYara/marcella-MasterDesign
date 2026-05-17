<?php

session_start();

require_once __DIR__ . '/../../config/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome  = trim($_POST['nome_completo']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se e-mail já existe
    $check = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check->execute([$email]);

    if ($check->fetch()) {
        echo "<script>alert('Este e-mail já está cadastrado. Tente fazer login.'); window.history.back();</script>";
        exit();
    }

    $senha_encriptada = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");

    if ($stmt->execute([$nome, $email, $senha_encriptada])) {

        $ultimo_id = $pdo->lastInsertId();

        $_SESSION['usuario_id'] = $ultimo_id;
        $_SESSION['usuario_nome'] = $nome;

        header("Location: /../../index.php");
        exit();
    } else {
        echo "<script>alert('Erro ao registar. Tente novamente.'); window.history.back();</script>";
    }
}
?>