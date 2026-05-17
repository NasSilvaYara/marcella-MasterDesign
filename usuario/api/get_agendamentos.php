<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(0);

require __DIR__ . '/../../config/db_config.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["erro" => "Usuário não logado"]);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

try {

    $sql = "SELECT 
                id, 
                data, 
                hora_inicio as hora, 
                servicos, 
                valor_total as valor, 
                status 
            FROM agendamentos 
            WHERE usuario_id = :usuario_id
            ORDER BY data ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();

    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($agendamentos);

} catch (Exception $e) {

    echo json_encode([
        "erro" => "Erro ao buscar agendamentos",
        "detalhe" => $e->getMessage()
    ]);
}