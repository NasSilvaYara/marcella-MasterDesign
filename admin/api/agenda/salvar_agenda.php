<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../../../config/db_config.php';

$dados = json_decode(file_get_contents('php://input'), true);

if (!$dados) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
    exit;
}

try {

    $status = $dados['status_dia'] ?? null;
    $tipo = $dados['tipo_registro'] ?? null;
    $abertura = $dados['horario_abertura'] ?? null;
    $fechamento = $dados['horario_fechamento'] ?? null;
    $p_inicio = $dados['inicio_intervalo'] ?? null;
    $p_fim = $dados['fim_intervalo'] ?? null;
    $mes = $dados['mes'] ?? null;
    $ano = $dados['ano'] ?? null;

    if ($tipo === 'padrao') {

        $diasArray = explode(',', $dados['dia_semana'] ?? '');

        foreach ($diasArray as $dia) {

            $dia = trim($dia);
            if ($dia === '') continue;

            $sql = "INSERT INTO configuracao_agenda 
            (status_dia, tipo_registro, dia_semana, horario_abertura, horario_fechamento, inicio_intervalo, fim_intervalo, mes, ano)
            VALUES (:status, :tipo, :dia, :abertura, :fechamento, :inicio, :fim, :mes, :ano)
            ON DUPLICATE KEY UPDATE
                status_dia = VALUES(status_dia),
                horario_abertura = VALUES(horario_abertura),
                horario_fechamento = VALUES(horario_fechamento),
                inicio_intervalo = VALUES(inicio_intervalo),
                fim_intervalo = VALUES(fim_intervalo)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':status' => $status,
                ':tipo' => $tipo,
                ':dia' => $dia,
                ':abertura' => $abertura,
                ':fechamento' => $fechamento,
                ':inicio' => $p_inicio,
                ':fim' => $p_fim,
                ':mes' => $mes,
                ':ano' => $ano
            ]);
        }

    } else {

        $data = $dados['data_especifica'] ?? null;

        $sql = "INSERT INTO configuracao_agenda 
        (status_dia, tipo_registro, data_especifica, horario_abertura, horario_fechamento, inicio_intervalo, fim_intervalo, mes, ano)
        VALUES (:status, :tipo, :data, :abertura, :fechamento, :inicio, :fim, :mes, :ano)
        ON DUPLICATE KEY UPDATE
            status_dia = VALUES(status_dia),
            horario_abertura = VALUES(horario_abertura),
            horario_fechamento = VALUES(horario_fechamento),
            inicio_intervalo = VALUES(inicio_intervalo),
            fim_intervalo = VALUES(fim_intervalo)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':status' => $status,
            ':tipo' => $tipo,
            ':data' => $data,
            ':abertura' => $abertura,
            ':fechamento' => $fechamento,
            ':inicio' => $p_inicio,
            ':fim' => $p_fim,
            ':mes' => $mes,
            ':ano' => $ano
        ]);
    }

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}