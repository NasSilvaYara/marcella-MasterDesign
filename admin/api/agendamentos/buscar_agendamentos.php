<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../../config/db_config.php';

try {
    $stmt = $pdo->query("SELECT id, cliente_nome, data, hora_inicio, hora_fim, servicos, status 
                         FROM agendamentos");

    $eventos = [];

    while ($row = $stmt->fetch()) {
        $eventos[] = [
            "id"    => $row["id"],
            "title" => $row["cliente_nome"] . " - " . $row["servicos"],
            "start" => $row["data"] . "T" . $row["hora_inicio"],
            "end"   => $row["data"] . "T" . $row["hora_fim"],
            "color" => $row["status"] == "confirmado" ? "#8b5cf6" : "#f59e0b"
        ];
    }

    echo json_encode($eventos);

} catch (PDOException $e) {
    echo json_encode(["erro" => "Erro no banco: " . $e->getMessage()]);
}