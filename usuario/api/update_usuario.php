<?php
session_start();
header("Content-Type: application/json");

require __DIR__ . '/../../config/db_config.php';

$data = json_decode(file_get_contents("php://input"), true);

$id = $_SESSION['usuario_id'];
$nome = $data['nome'];
$email = $data['email'];
$senhaAtual = $data['senhaAtual'] ?? null;
$novaSenha = $data['novaSenha'] ?? null;

try {

    $stmt = $pdo->prepare("SELECT senha FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        echo json_encode(["erro" => "Usuário não encontrado"]);
        exit;
    }

    if (!empty($novaSenha)) {

        if (!password_verify($senhaAtual, $usuario['senha'])) {
            echo json_encode(["erro" => "Senha atual incorreta"]);
            exit;
        }

        $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $novaSenhaHash, $id]);

    } else {
        $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $id]);
    }

    echo json_encode(["sucesso" => true]);

} catch (Exception $e) {
    echo json_encode(["erro" => $e->getMessage()]);
}