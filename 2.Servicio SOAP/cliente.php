<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha enviado el formulario
    $id = $_POST['id'];

    // Crear el cliente SOAP

    $client = new SoapClient(
        null,
        array(
            'location' => 'http://localhost/2EV/Simulacro/2.Servicio%20SOAP/server.php',
            'uri' => 'http://localhost/2EV/Simulacro/2.Servicio%20SOAP/'
        )
    );

    // Llamar al método del servicio SOAP
    $resultado = $client->getPrecioVivienda($id);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultado de la Verificación de Edad</title>
</head>

<body>
    <h2>Precio de la vivienda:</h2>
    <?php if (isset($resultado)): ?>

        <p>Precio:
            <?php echo $resultado; ?>
        </p>
    <?php endif; ?>
    <p><a href="index.php">Volver al formulario</a></p>
</body>

</html>