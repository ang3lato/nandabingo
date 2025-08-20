<?php
header('Content-Type: text/html; charset=UTF-8');

if (!isset($_GET['numbers']) || empty($_GET['numbers'])) {
    http_response_code(400);
    echo "<h1>Error: No se han proporcionado números.</h1>";
    exit();
}

$numbersToSave = explode(',', $_GET['numbers']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pago - NANDA BINGO</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #1a1a2e;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            padding: 20px;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.4);
            padding: 40px;
            border-radius: 15px;
            max-width: 600px;
        }
        h1 {
            color: #00ffff;
            text-shadow: 0 0 5px #00ffff;
        }
        .whatsapp-button {
            display: inline-block;
            margin-top: 20px;
            padding: 15px 30px;
            font-size: 1.2em;
            font-weight: bold;
            color: white;
            background: linear-gradient(45deg, #25d366, #128c7e);
            border: none;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 0 10px #25d366;
            transition: transform 0.2s;
        }
        .whatsapp-button:hover {
            transform: scale(1.05);
        }
        #numbers-list {
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Números Seleccionados!</h1>
        <p>Tus números (<span id="numbers-list"></span>) han sido reservados. Para confirmar tu compra, realiza el pago y envía el comprobante por WhatsApp.</p>
        
        <h2>Método de Pago</h2>
        <p>Aceptamos pagos por:</p>
        <p><b>BINANCE:</b> USDT, TASA DEL DIA</p>
        <p><b>PAGO MOVIL:</b> BS</p>
        <p><b>ZINLI:</b> USD</p>
        
        <a id="whatsapp-link" class="whatsapp-button" href="#" target="_blank">
            Enviar Comprobante por WhatsApp
        </a>
    </div>

    <script>
        const selectedNumbers = <?php echo json_encode($numbersToSave); ?>;
        document.getElementById('numbers-list').textContent = selectedNumbers.join(', ');

        const whatsappMessage = encodeURIComponent(
            `Hola, he seleccionado los siguientes números para el bingo: ${selectedNumbers.join(', ')}. Aca dejo el comprobante de pago.`
        );
        const whatsappLink = document.getElementById('whatsapp-link');
        whatsappLink.href = `https://wa.me/584144134350?text=${whatsappMessage}`;
    </script>
</body>
</html>