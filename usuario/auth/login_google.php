<?php
session_start();

header('Content-Type: application/json; charset=utf-8');
header("Cross-Origin-Opener-Policy: same-origin-allow-popups");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../../config/db_config.php";

try {

    $raw = file_get_contents("php://input");

    if (!$raw) {
        echo json_encode([
            'success' => false,
            'message' => 'Body vazio'
        ]);
        exit;
    }

    $data = json_decode($raw, true);

    if (!isset($data['credential'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Credential não enviado',
            'raw' => $raw
        ]);
        exit;
    }

    $id_token = $data['credential'];

    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        throw new Exception("Erro cURL: " . curl_error($ch));
    }

    curl_close($ch);

    if (!$response) {
        throw new Exception("Resposta vazia do Google");
    }

    $user = json_decode($response, true);

    if (!$user) {
        throw new Exception("JSON inválido do Google");
    }

    $CLIENT_ID = "821436734385-7cdnrc9a23v52qkfekevi35sumdr4so8.apps.googleusercontent.com";

    if (!isset($user['email']) || $user['aud'] !== $CLIENT_ID) {
        echo json_encode([
            'success' => false,
            'message' => 'Token inválido',
            'debug' => $user
        ]);
        exit;
    }

    $stmt = $pdo->prepare("SELECT id, nome FROM usuarios WHERE email = ?");
    $stmt->execute([$user['email']]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $usuario_id = $usuario['id'];
        $nome_final = $usuario['nome'];
    } else {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");
        $stmt->execute([$user['name'], $user['email']]);

        $usuario_id = $pdo->lastInsertId();
        $nome_final = $user['name'];
    }

    $_SESSION['usuario_id'] = $usuario_id;
    $_SESSION['usuario_nome'] = $nome_final;
    $_SESSION['usuario_email'] = $user['email'];

    echo json_encode([
        'success' => true,
        'usuario' => [
            'id' => $usuario_id,
            'nome' => $nome_final,
            'email' => $user['email']
        ]
    ]);

} catch (Exception $e) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Erro interno',
        'error' => $e->getMessage()
    ]);
}