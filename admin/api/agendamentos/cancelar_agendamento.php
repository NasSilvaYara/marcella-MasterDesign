<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../../config/db_config.php';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$id = $_POST["id"] ?? null;

if (!$id) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}

$stmt = $conn->prepare("UPDATE agendamentos SET status='cancelado' WHERE id=?");

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["erro" => "Erro ao cancelar"]);
}