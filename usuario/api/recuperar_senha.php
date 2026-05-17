<?php
header("Content-Type: application/json");
require "../../config/db_config.php";

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];

try {
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        echo json_encode(["erro" => "Email não encontrado"]);
        exit;
    }

    $token = bin2hex(random_bytes(32));
    $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $stmt = $pdo->prepare("UPDATE usuarios SET reset_token = ?, reset_expira = ? WHERE email = ?");
    $stmt->execute([$token, $expira, $email]);

    $link = "http://localhost/reset_senha.html?token=$token";

    echo json_encode([
        "sucesso" => true,
        "link_teste" => $link
    ]);

} catch (Exception $e) {
    echo json_encode(["erro" => $e->getMessage()]);
}