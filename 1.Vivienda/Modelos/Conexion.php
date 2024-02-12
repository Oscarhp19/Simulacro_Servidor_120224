<?php

class Conexion
{
    private $DB_SERVER;
    private $DB_PORT;
    private $DB_NAME;
    private $DB_USER;
    private $DB_PASSWORD;
    private $DB_DSN;
    private PDO $conexion;

    public function __construct($DB_SERVER, $DB_PORT, $DB_NAME, $DB_USER, $DB_PASSWORD)
    {
        $this->DB_SERVER = $DB_SERVER;
        $this->DB_PORT = $DB_PORT;
        $this->DB_NAME = $DB_NAME;
        $this->DB_USER = $DB_USER;
        $this->DB_PASSWORD = $DB_PASSWORD;
        $this->DB_DSN = "mysql://mysql:host=" . $this->DB_SERVER . ";port=" . $this->DB_PORT . ";dbname=" . $this->DB_NAME . ";charset=utf8mb4";
        $this->conexion = new PDO($this->DB_DSN, $this->DB_USER, $this->DB_PASSWORD);
    }

    public function getConnection(): PDO
    {
        return $this->conexion;
    }

    public function ejecutarConsulta($sql)
    {
        // Utilizar el método prepare() de PDO para preparar una consulta
        $stmt = $this->conexion->prepare($sql);

        // Resto de la lógica para ejecutar la consulta, por ejemplo, bindParam, execute, etc.


        return $stmt;
    }
}
?>