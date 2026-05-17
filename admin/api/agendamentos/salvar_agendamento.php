<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
require_once __DIR__ . '/../../../config/db_config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "erro", "msg" => "Dados inválidos"]);
    exit;
}

$usuario_id = $data["usuario_id"] ?? null;
$cliente_email = $data["email"] ?? null;
$cliente_nome = $data["cliente_nome"] ?? null;
$cliente_whatsapp = $data["whatsapp"] ?? null;
$data_agenda = $data["data"] ?? null;
$hora_inicio = $data["hora_inicio"] ?? null;
$duracao = $data["duracao"] ?? 0;
$valor_total = $data["valor_total"] ?? 0;
$servicos = json_encode($data["servicos"] ?? []);

if (!$cliente_nome || !$data_agenda || !$hora_inicio) {
    echo json_encode([
        "status" => "erro",
        "msg" => "Dados obrigatórios faltando",
        "debug" => $data
    ]);
    exit;
}

$hora_fim = date("H:i:s", strtotime("+{$duracao} minutes", strtotime($hora_inicio)));

$sqlCheck = "
SELECT COUNT(*) 
FROM agendamentos 
WHERE usuario_id = :usuario_id
AND data = :data
AND (
    hora_inicio < :hora_fim
    AND hora_fim > :hora_inicio
)
";

$stmtCheck = $pdo->prepare($sqlCheck);

$stmtCheck->bindParam(":usuario_id", $usuario_id);
$stmtCheck->bindParam(":data", $data_agenda);
$stmtCheck->bindParam(":hora_inicio", $hora_inicio);
$stmtCheck->bindParam(":hora_fim", $hora_fim);

$stmtCheck->execute();

$conflito = $stmtCheck->fetchColumn();

if ($conflito > 0) {
    echo json_encode([
        "status" => "erro",
        "msg" => "Horário já ocupado"
    ]);
    exit;
}

try {

    $sql = "INSERT INTO agendamentos (
    usuario_id,
    cliente_nome,
    cliente_email,
    cliente_whatsapp,
    data,
    hora_inicio,
    hora_fim,
    valor_total,
    servicos, 
    status
)
VALUES (
    :usuario_id,
    :cliente_nome,
    :cliente_email,
    :cliente_whatsapp,
    :data,
    :hora_inicio,
    :hora_fim,
    :valor_total,
    :servicos, 
    'pendente'
)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->bindParam(":cliente_nome", $cliente_nome);
    $stmt->bindParam(":cliente_email", $cliente_email);
    $stmt->bindParam(":cliente_whatsapp", $cliente_whatsapp);
    $stmt->bindParam(":data", $data_agenda);
    $stmt->bindParam(":hora_inicio", $hora_inicio);
    $stmt->bindParam(":hora_fim", $hora_fim);
    $stmt->bindParam(":valor_total", $valor_total);
    $stmt->bindParam(":servicos", $servicos);

    $stmt->execute();

    echo json_encode([
        "status" => "ok",
        "msg" => "Agendamento salvo com sucesso"
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "erro",
        "msg" => $e->getMessage()
    ]);
}