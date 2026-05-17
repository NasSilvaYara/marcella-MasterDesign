<?php

header("Content-Type: application/json");

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../../config/db_config.php';

$mes = $_GET['mes'] ?? date('n');
$ano = $_GET['ano'] ?? date('Y');

$sql = "
SELECT *
FROM configuracao_agenda
WHERE mes = :mes
AND ano = :ano
ORDER BY id ASC
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':mes' => $mes,
    ':ano' => $ano
]);

$configuracoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$padrao = [];
$excecoes = [];

foreach ($configuracoes as $config) {

    if ($config['tipo_registro'] === 'padrao') {
        $padrao[] = $config;
    }

    if ($config['tipo_registro'] === 'excecao') {
        $excecoes[] = $config;
    }
}

echo json_encode([
    'padrao' => $padrao,
    'excecoes' => $excecoes
]);