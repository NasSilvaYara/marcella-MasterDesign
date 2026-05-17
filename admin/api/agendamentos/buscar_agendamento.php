<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../../config/db_config.php';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$id = $_GET["id"] ?? null;

if (!$id) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}

$stmt = $conn->prepare("
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
WHERE id=?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$res = $stmt->get_result();

if ($res->num_rows == 0) {
    echo json_encode(["erro" => "Agendamento não encontrado"]);
    exit;
}

echo json_encode($res->fetch_assoc());