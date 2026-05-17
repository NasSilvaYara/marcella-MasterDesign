<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../../config/db_config.php';

$id = $_GET["id"] ?? null;

if (!$id) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}

try {
    $stmt = $pdo->prepare("
    SELECT 
        id,
        cliente_nome,
        cliente_whatsapp,
        cliente_email,
        data,
        hora_inicio,
        hora_fim,
        servicos,
        valor_total,
        status
    FROM agendamentos
    WHERE id = ?
    ");

    $stmt->execute([$id]);
    $agendamento = $stmt->fetch();

    if (!$agendamento) {
        echo json_encode(["erro" => "Agendamento não encontrado"]);
        exit;
    }

    echo json_encode($agendamento);

} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro no banco: " . $e->getMessage()]);
}