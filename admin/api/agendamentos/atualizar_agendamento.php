<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

require_once("../../../config/db_config.php");

$dados = json_decode(file_get_contents("php://input"), true);

$id = $dados["id"] ?? null;
$data = $dados["data"] ?? null;
$hora_inicio = $dados["hora_inicio"] ?? null;
$hora_fim = $dados["hora_fim"] ?? null;
$status = mb_strtolower(trim($dados["status"] ?? ""), 'UTF-8');
$status = str_replace("concluído", "concluido", $status);
$servicos = $dados["servicos"] ?? null;

if (!$id) {
    echo json_encode([
        "sucesso" => false,
        "erro" => "ID não informado"
    ]);
    exit;
}

if (!$status) {
    echo json_encode([
        "sucesso" => false,
        "erro" => "Status não informado"
    ]);
    exit;
}

$statusValidos = ["pendente", "concluido", "cancelado"];

if (!in_array($status, $statusValidos)) {
    echo json_encode([
        "sucesso" => false,
        "erro" => "Status inválido"
    ]);
    exit;
}

$servicosJson = null;

if ($servicos !== null) {
    $servicosJson = json_encode($servicos, JSON_UNESCAPED_UNICODE);
}

try {

    $sql = "UPDATE agendamentos 
            SET 
                data = :data,
                hora_inicio = :hora_inicio,
                hora_fim = :hora_fim,
                status = :status,
                servicos = :servicos
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":data" => $data ?: null,
        ":hora_inicio" => $hora_inicio ?: null,
        ":hora_fim" => $hora_fim ?: null,
        ":status" => $status,
        ":servicos" => $servicosJson,
        ":id" => $id
    ]);

    echo json_encode([
        "sucesso" => true,
        "mensagem" => "Agendamento atualizado com sucesso"
    ]);
} catch (PDOException $e) {

    echo json_encode([
        "sucesso" => false,
        "erro" => "Erro no banco: " . $e->getMessage()
    ]);
}
