<?php
include_once "Conexion.php";
include_once "Tabla.php";
abstract class Crud extends Conexion
{
    private Tabla $tabla;
    protected Conexion $connection;

    protected PDO $conexion;

    public function __construct($tableName, $tableIdColumn)
    {
        $this->tabla = new Tabla($tableName, $tableIdColumn);
        $this->connection = new Conexion("localhost", 3306, "inmobiliaria", "root", "admin");
        $this->conexion = $this->connection->getConnection();
    }

    public function obtieneTodos()
    {
        $query = $this->conexion->prepare("SELECT * FROM  {$this->tabla->tableName}");
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $clase = $this::class;
        foreach ($rows as $i => $row)
            $users[$i] = new $clase(...$row);
        return $users;
    }

    public function obtieneDeID($id)
    {
        $query = $this->conexion->prepare("SELECT * FROM {$this->tabla->tableName} WHERE {$this->tabla->idColumnName} = :idData ");
        $query->bindValue(":idData", $id, PDO::PARAM_INT);
        $query->execute();
        $clase = $this::class;
        return new $clase(...$query->fetch(PDO::FETCH_ASSOC));
    }

    public function borrar($id)
    {
        $query = $this->conexion->prepare("DELETE FROM {$this->tabla->tableName} WHERE {$this->tabla->idColumnName} = :idData ");
        $query->bindValue(":idData", $id);
        return $query->execute();
    }

    public abstract function crear();
    public abstract function actualizar();

}
?>