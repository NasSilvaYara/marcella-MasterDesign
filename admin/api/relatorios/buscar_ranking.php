<?php

header("Content-Type: application/json");

include __DIR__ . '/../../../config/db_config.php';

try {

    $mes       = isset($_GET['mes']) ? intval($_GET['mes']) : date('m');
    $ano       = isset($_GET['ano']) ? intval($_GET['ano']) : date('Y');
    $categoria = $_GET['categoria'] ?? '';

    $stmt = $pdo->prepare("
        SELECT servicos, valor_total
        FROM agendamentos
        WHERE status = 'concluido'
        AND servicos IS NOT NULL
        AND MONTH(data) = :mes
        AND YEAR(data) = :ano
    ");

    $stmt->execute([':mes' => $mes, ':ano' => $ano]);
    $agendamentos = $stmt->fetchAll();

    $ranking = [];

    foreach ($agendamentos as $agendamento) {

        $servicos = json_decode($agendamento['servicos'], true);
        if (!$servicos) continue;

        foreach ($servicos as $servico) {

            $nome      = $servico['nome']      ?? 'Sem nome';
            $preco     = floatval($servico['preco'] ?? 0);
            $cat       = $servico['categoria'] ?? '';

            // Filtra por categoria se informada
            if ($categoria !== '' && $cat !== $categoria) continue;

            if (!isset($ranking[$nome])) {
                $ranking[$nome] = ['nome' => $nome, 'valor' => 0, 'quantidade' => 0];
            }

            $ranking[$nome]['valor']      += $preco;
            $ranking[$nome]['quantidade'] ++;
        }
    }

    usort($ranking, fn($a, $b) => $b['valor'] <=> $a['valor']);

    echo json_encode([
        'success' => true,
        'ranking' => array_values($ranking)
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'erro' => $e->getMessage()]);
}