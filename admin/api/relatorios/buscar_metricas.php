<?php

header("Content-Type: application/json");

include '../../../config/db_config.php';

try {

    $mes = isset($_GET['mes']) ? intval($_GET['mes']) : date('m');
    $ano = isset($_GET['ano']) ? intval($_GET['ano']) : date('Y');

    $sql = "
        SELECT

            COALESCE(SUM(valor_total), 0) AS faturamento_bruto,

            COUNT(*) AS total_agendamentos,

            COALESCE(AVG(valor_total), 0) AS ticket_medio

        FROM agendamentos

        WHERE status = 'concluido'

        AND MONTH(data) = :mes
        AND YEAR(data) = :ano
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':mes' => $mes,
        ':ano' => $ano
    ]);

    $dados = $stmt->fetch();

$sqlOcupadas = "

    SELECT
        SUM(
            TIME_TO_SEC(
                TIMEDIFF(hora_fim, hora_inicio)
            )
        ) / 3600 AS horas_ocupadas

    FROM agendamentos

    WHERE status != 'cancelado'

    AND MONTH(data) = :mes
    AND YEAR(data) = :ano

";

$stmtOcupadas = $pdo->prepare($sqlOcupadas);

$stmtOcupadas->execute([
    ':mes' => $mes,
    ':ano' => $ano
]);

$ocupadas = $stmtOcupadas->fetch();

$horasOcupadas = $ocupadas['horas_ocupadas'] ?? 0;

$sqlDisponiveis = "

    SELECT

        SUM(

            (
                TIME_TO_SEC(
                    TIMEDIFF(horario_fechamento, horario_abertura)
                )

                -

                TIME_TO_SEC(
                    TIMEDIFF(fim_intervalo, inicio_intervalo)
                )

            )

        ) / 3600 AS horas_disponiveis

    FROM configuracao_agenda

    WHERE status_dia = 'trabalho'

    AND mes = :mes
    AND ano = :ano

";

$stmtDisponiveis = $pdo->prepare($sqlDisponiveis);

$stmtDisponiveis->execute([
    ':mes' => $mes,
    ':ano' => $ano
]);

$disponiveis = $stmtDisponiveis->fetch();

$horasDisponiveis = $disponiveis['horas_disponiveis'] ?? 0;

$taxaOcupacao = 0;

if ($horasDisponiveis > 0) {

    $taxaOcupacao =
        ($horasOcupadas / $horasDisponiveis) * 100;
}

   echo json_encode([
    'success' => true,

    'faturamento_bruto' => $dados['faturamento_bruto'],

    'ticket_medio' => $dados['ticket_medio'],

    'total_agendamentos' => $dados['total_agendamentos'],

    'taxa_ocupacao' => round($taxaOcupacao, 1)

]);

} catch (PDOException $e) {

    echo json_encode([
        'success' => false,
        'erro' => $e->getMessage()
    ]);

}