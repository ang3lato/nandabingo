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

try {
    $stmt = $db->query("SELECT number FROM sold_numbers ORDER BY number ASC");
    $soldNumbers = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    echo json_encode(["soldNumbers" => $soldNumbers]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al obtener los números: " . $e->getMessage()]);
}
?>