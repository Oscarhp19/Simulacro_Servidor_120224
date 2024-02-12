<?php
class PrecioVivienda
{
    public function getPrecioVivienda($id)
    {
        $servername = "localhost";
        $port = 3306;
        $database = "inmobiliaria";
        $username = "root";
        $password = "";



        try {
            $conexion = new PDO("mysql:host=$servername;port=$port;dbname=$database", $username, $password);
            // Establecer el modo de error de PDO a excepción
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Conexión fallida: " . $e->getMessage();
        }


        $sql = "SELECT ndormitorios, precio FROM viviendas WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['ndormitorios'] == '3' || $result["ndormitorios"] == "4" || $result["ndormitorios"] == "5 o más") {
            $precio = $result["precio"];
        } else {
            $precio = "No se cumplen los requisitos";
        }

        return $precio;


    }
}

$server = new SoapServer(null, array('uri' => 'http://localhost/2EV/Simulacro/2.Servicio%20SOAP/'));
$server->setClass('PrecioVivienda');
$server->handle();
