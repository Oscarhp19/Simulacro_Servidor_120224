<?php
class Tabla
{
    public $tableName;
    public $idColumnName;

    public function __construct($nombreTabla, $columnaId)
    {
        $this->tableName = $nombreTabla;
        $this->idColumnName = $columnaId;
    }
}
?>