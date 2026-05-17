<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../../config/db_config.php';

$id = $_POST["id"] ?? null;

if (!$id) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE agendamentos SET status='cancelado' WHERE id=?");

    if ($stmt->execute([$id])) {
        echo json_encode(["sucesso" => true]);
    } else {
        echo json_encode(["erro" => "Erro ao cancelar"]);
    }

} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro no banco: " . $e->getMessage()]);
}