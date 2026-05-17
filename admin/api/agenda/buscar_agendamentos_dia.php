

<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../../config/db_config.php';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$data = $_GET['data'];

$sql = "SELECT hora_inicio, duracao 
        FROM agendamentos
        WHERE data = '$data' 
        AND status != 'cancelado'";

$res = $conn->query($sql);

$lista = [];

while ($row = $res->fetch_assoc()) {
    $lista[] = $row;
}

echo json_encode($lista);