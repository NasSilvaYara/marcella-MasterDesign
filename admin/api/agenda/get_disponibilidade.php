<?php

header("Content-Type: application/json");

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../../config/db_config.php';

$data = $_GET['data'] ?? date('Y-m-d');

$timestampData = strtotime($data);

$diasSemana = [
    1 => 'Segunda',
    2 => 'Terça',
    3 => 'Quarta',
    4 => 'Quinta',
    5 => 'Sexta',
    6 => 'Sábado',
    7 => 'Domingo'
];

$diaSemana = $diasSemana[date('N', $timestampData)];

$mes = date('n', $timestampData);

$ano = date('Y', $timestampData);

$sqlConfig = "
SELECT *
FROM configuracao_agenda
WHERE mes = :mes
AND ano = :ano
AND (
    data_especifica = :data
    OR FIND_IN_SET(:dia_semana, dia_semana)
)
ORDER BY
CASE
    WHEN data_especifica = :data THEN 1
    ELSE 2
END
LIMIT 1
";

$stmtConfig = $pdo->prepare($sqlConfig);

$stmtConfig->execute([
    ':mes' => $mes,
    ':ano' => $ano,
    ':data' => $data,
    ':dia_semana' => $diaSemana
]);

$config = $stmtConfig->fetch(PDO::FETCH_ASSOC);

if (!$config) {

    echo json_encode([
        "data" => $data,
        "horarios_disponiveis" => [],
        "debug" => "Nenhuma configuração encontrada"
    ]);

    exit;
}

if ($config['status_dia'] !== 'trabalho') {

    echo json_encode([
        "data" => $data,
        "horarios_disponiveis" => [],
        "debug" => "Dia marcado como fechado"
    ]);

    exit;
}

$horarioAbertura = $config['horario_abertura'];
$horarioFechamento = $config['horario_fechamento'];

$inicioIntervalo = $config['inicio_intervalo'];
$fimIntervalo = $config['fim_intervalo'];

$duracaoSlot = 30;

$inicio = strtotime($horarioAbertura);

$fim = strtotime($horarioFechamento);

$horarios = [];

while ($inicio < $fim) {

    $horaAtual = date('H:i', $inicio);

    $slotInicio = strtotime($horaAtual);

    $slotFim = strtotime("+{$duracaoSlot} minutes", $slotInicio);

    $dentroIntervalo = false;

    if (
        !empty($inicioIntervalo) &&
        !empty($fimIntervalo) &&
        $inicioIntervalo !== '00:00:00' &&
        $fimIntervalo !== '00:00:00'
    ) {

        $inicioInt = strtotime($inicioIntervalo);

        $fimInt = strtotime($fimIntervalo);

        if (
            $slotInicio < $fimInt &&
            $slotFim > $inicioInt
        ) {
            $dentroIntervalo = true;
        }
    }

    $horarioPassado = false;

    if ($data === date('Y-m-d')) {

        if ($slotInicio <= time()) {
            $horarioPassado = true;
        }
    }  

    if (!$dentroIntervalo && !$horarioPassado) {

        $horarios[] = $horaAtual;
    }

    $inicio = strtotime("+{$duracaoSlot} minutes", $inicio);
}

$sqlAg = "
SELECT hora_inicio, hora_fim
FROM agendamentos
WHERE data = :data
AND status != 'cancelado'
";

$stmtAg = $pdo->prepare($sqlAg);

$stmtAg->execute([
    ':data' => $data
]);

$agendamentos = $stmtAg->fetchAll(PDO::FETCH_ASSOC);


$disponiveis = [];

foreach ($horarios as $slot) {

    $ocupado = false;

    $slotInicio = strtotime($slot);

    $slotFim = strtotime("+{$duracaoSlot} minutes", $slotInicio);

    foreach ($agendamentos as $agendamento) {

        $inicioAg = strtotime($agendamento['hora_inicio']);

        $fimAg = strtotime($agendamento['hora_fim']);

        if (
            $slotInicio < $fimAg &&
            $slotFim > $inicioAg
        ) {
            $ocupado = true;
            break;
        }
    }

    if (!$ocupado) {

        $disponiveis[] = $slot;
    }
}


echo json_encode([
    "data" => $data,
    "configuracao" => $config,
    "horarios_disponiveis" => $disponiveis
]);