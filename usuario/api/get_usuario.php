<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(0);

require __DIR__ . '/../../config/db_config.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["erro" => "Não logado"]);
    exit;
}

$id = $_SESSION['usuario_id'];

$stmt = $pdo->prepare("SELECT nome, email FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

$usuario = $stmt->fetch();

echo json_encode($usuario);