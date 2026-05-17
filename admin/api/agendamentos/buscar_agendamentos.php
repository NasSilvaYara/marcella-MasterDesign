<?php

header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "marcella_beauty");

if ($conn->connect_error) {
    echo json_encode(["erro" => "Erro conexão"]);
    exit;
}

$sql = "SELECT id, cliente_nome, data, hora_inicio, hora_fim, servicos, status 
        FROM agendamentos";

$res = $conn->query($sql);

$eventos = [];

while ($row = $res->fetch_assoc()) {

    $eventos[] = [
        "id" => $row["id"],
        "title" => $row["cliente_nome"] . " - " . $row["servicos"],

        "start" => $row["data"] . "T" . $row["hora_inicio"],
        "end"   => $row["data"] . "T" . $row["hora_fim"],

        "color" => $row["status"] == "confirmado" ? "#8b5cf6" : "#f59e0b"
    ];
}

echo json_encode($eventos);