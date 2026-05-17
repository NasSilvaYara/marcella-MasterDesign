<?php
session_start();
header('Content-Type: application/json');

require '../../config/db_config.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["erro" => "Usuário não logado"]);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

try {

    $stmt = $pdo->prepare("DELETE FROM agendamentos WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);

    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);

    session_destroy();

    echo json_encode(["sucesso" => true]);

} catch (Exception $e) {
    echo json_encode([
        "erro" => "Erro ao excluir conta",
        "detalhe" => $e->getMessage()
    ]);
}