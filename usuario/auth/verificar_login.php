<?php
session_start();
header('Content-Type: application/json');

echo json_encode([
    "logado" => isset($_SESSION['usuario_id']),
    "id" => $_SESSION['usuario_id'] ?? null,
    "nome" => $_SESSION['usuario_nome'] ?? null,
    "email" => $_SESSION['usuario_email'] ?? null
]);