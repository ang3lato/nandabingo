<?php
header('Content-Type: application/json');

require_once 'modeldb.php';
$dbConex = new dbConex();
$db = $dbConex->conex();

if (!$db) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión a la base de datos."]);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['numbers']) || !is_array($data['numbers']) || empty($data['numbers'])) {
    http_response_code(400);
    echo json_encode(["error" => "Debes proporcionar una lista de números."]);
    exit();
}

$numbersToSave = $data['numbers'];

try {
    $stmt = $db->prepare("INSERT INTO sold_numbers (number, status) VALUES (?, 'pending')");
    
    foreach ($numbersToSave as $number) {
        $stmt->execute([$number]);
    }

    // Devuelve un mensaje de éxito en JSON en lugar de redirigir
    echo json_encode(["success" => true, "numbers" => $numbersToSave]);
    exit();

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al guardar los números: " . $e->getMessage()]);
    exit();
}
?>