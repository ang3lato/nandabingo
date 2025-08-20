<?php
// Agrega una contraseña simple para proteger esta página
$password = '30680016';
if (!isset($_GET['pass']) || $_GET['pass'] !== $password) {
    die("Acceso Denegado");
}

require_once 'modeldb.php';
$dbConex = new dbConex();
$db = $dbConex->conex();

if (!$db) {
    die("Error de conexión a la base de datos.");
}

$message = '';
// Lógica para confirmar un número
if (isset($_GET['confirm'])) {
    $numberToConfirm = intval($_GET['confirm']);
    try {
        $stmt = $db->prepare("UPDATE sold_numbers SET status = 'confirmed' WHERE number = ?");
        $stmt->execute([$numberToConfirm]);
        $message = "Número " . $numberToConfirm . " confirmado con éxito.";
    } catch (PDOException $e) {
        $message = "Error al confirmar el número.";
    }
}

// Lógica para borrar un número
if (isset($_GET['delete'])) {
    $numberToDelete = intval($_GET['delete']);
    try {
        $stmt = $db->prepare("DELETE FROM sold_numbers WHERE number = ?");
        $stmt->execute([$numberToDelete]);
        $message = "Número " . $numberToDelete . " eliminado con éxito.";
    } catch (PDOException $e) {
        $message = "Error al eliminar el número.";
    }
}

// Obtener la lista de números pendientes
$pendingNumbers = [];
try {
    $stmt = $db->query("SELECT number, status FROM sold_numbers ORDER BY status DESC, number ASC");
    $pendingNumbers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener la lista de números.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #1a1a2e; color: white; padding: 20px; }
        .container { max-width: 800px; margin: auto; }
        h1 { color: #ff0080; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background-color: #333; }
        .status-pending { color: orange; font-weight: bold; }
        .status-confirmed { color: #00ffff; font-weight: bold; }
        .action-link { margin-left: 10px; color: #ff0080; text-decoration: none; }
        .action-link:hover { text-decoration: underline; }
        .message { color: lightgreen; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Panel de Administración</h1>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>Número</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pendingNumbers)): ?>
                    <tr><td colspan="3">No hay números pendientes o vendidos.</td></tr>
                <?php else: ?>
                    <?php foreach ($pendingNumbers as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['number']); ?></td>
                            <td><span class="status-<?php echo $item['status']; ?>"><?php echo htmlspecialchars($item['status']); ?></span></td>
                            <td>
                                <?php if ($item['status'] === 'pending'): ?>
                                    <a href="admin.php?pass=<?php echo $password; ?>&confirm=<?php echo $item['number']; ?>" class="action-link">Confirmar Pago</a>
                                    <a href="admin.php?pass=<?php echo $password; ?>&delete=<?php echo $item['number']; ?>" class="action-link">Eliminar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>