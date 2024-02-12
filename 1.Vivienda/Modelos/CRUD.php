<?php
include_once "C:/xampp/htdocs/2EV/Simulacro/1.Vivienda/Modelos/Conexion.php";
include_once "C:/xampp/htdocs/2EV/Simulacro/1.Vivienda/Modelos/Tabla.php";
abstract class Crud extends Conexion
{
    private Tabla $tabla;
    protected Conexion $connection;

    protected PDO $conexion;

    public function __construct($tableName, $tableIdColumn)
    {
        $this->tabla = new Tabla($tableName, $tableIdColumn);
        $this->connection = new Conexion("localhost", 3306, "inmobiliaria", "root", "");
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

    public function obtieneViviendasPaginadas()
    {
        try {

            $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;


            $alumnosPorPagina = 4;
            $inicio = ($paginaActual - 1) * $alumnosPorPagina;



            $sql = "SELECT * FROM alumnos LIMIT $inicio, $alumnosPorPagina;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $sql2 = "SELECT * FROM alumnos;";

            $stmt2 = $this->conexion->prepare($sql2);
            $stmt2->execute();
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);

            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($alumnos = $stmt->fetch()) {
                        $codigo = $alumnos['CODIGO'];
                        $nombre = $alumnos['NOMBRE'];
                        $apellidos = $alumnos['APELLIDOS'];
                        $telefono = $alumnos['TELEFONO'];
                        $correo = $alumnos['CORREO'];

                        ?>
                        <tr>
                            <td>
                                <?= $codigo ?>
                            </td>
                            <td>
                                <?= $nombre ?>
                            </td>
                            <td>
                                <?= $apellidos ?>
                            </td>
                            <td>
                                <?= $telefono ?>
                            </td>
                            <td>
                                <?= $correo ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <?php

            $numPaginas = ceil($stmt2->rowCount() / $alumnosPorPagina);
            for ($i = 1; $i <= $numPaginas; $i++) {
                echo "<a href='index.php?pagina=$i'><button>$i</button></a>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conexion = null;

        return $stmt;

    }
}
?>