<?php
header("Content-Type: application/json");
require __DIR__ . '/../../config/db_config.php';

$data = json_decode(file_get_contents("php://input"), true);

$token = $data['token'];
$novaSenha = $data['novaSenha'];

try {
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE reset_token = ? AND reset_expira > NOW()");
    $stmt->execute([$token]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        echo json_encode(["erro" => "Token inválido ou expirado"]);
        exit;
    }

    $hash = password_hash($novaSenha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE usuarios SET senha = ?, reset_token = NULL, reset_expira = NULL WHERE id = ?");
    $stmt->execute([$hash, $usuario['id']]);

    echo json_encode(["sucesso" => true]);

} catch (Exception $e) {
    echo json_encode(["erro" => $e->getMessage()]);
}