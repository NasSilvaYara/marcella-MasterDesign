<?php

header("Content-Type: application/json");

include '../../../config/db_config.php';

try {

    $mes = isset($_GET['mes']) ? intval($_GET['mes']) : date('m');
    $ano = isset($_GET['ano']) ? intval($_GET['ano']) : date('Y');

    $sql = "
        SELECT 
            DAYOFWEEK(data) AS dia_semana,
            SUM(valor_total) AS total
        FROM agendamentos
        WHERE status = 'concluido'
        AND MONTH(data) = :mes
        AND YEAR(data) = :ano
        GROUP BY DAYOFWEEK(data)
        ORDER BY DAYOFWEEK(data)
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':mes' => $mes, ':ano' => $ano]);
    $rows = $stmt->fetchAll();

    $mapa = [
        2 => ['label' => 'Seg', 'total' => 0],
        3 => ['label' => 'Ter', 'total' => 0],
        4 => ['label' => 'Qua', 'total' => 0],
        5 => ['label' => 'Qui', 'total' => 0],
        6 => ['label' => 'Sex', 'total' => 0],
        7 => ['label' => 'Sáb', 'total' => 0],
    ];

    foreach ($rows as $row) {
        $dia = intval($row['dia_semana']);
        if (isset($mapa[$dia])) {
            $mapa[$dia]['total'] = floatval($row['total']);
        }
    }

    $labels = array_column(array_values($mapa), 'label');
    $valores = array_column(array_values($mapa), 'total');

    echo json_encode([
        'success' => true,
        'labels'  => $labels,
        'valores' => $valores
    ]);

} catch (PDOException $e) {

    echo json_encode([
        'success' => false,
        'erro' => $e->getMessage()
    ]);

}