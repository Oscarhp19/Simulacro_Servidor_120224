<?php

include_once("C:/xampp/htdocs/2EV/Simulacro/1.Vivienda/Modelos/Crud.php");

class Vivienda extends Crud
{
    private $id;
    private $tipo;
    private $zona;
    private $direccion;
    private $ndormitorios;
    private $precio;
    private $tamano;
    private $extras;
    private $observaciones;
    private $fecha_anuncio;

    function __construct($id, $tipo, $zona, $direccion, $ndormitorios, $precio, $tamano, $extras, $observaciones, $fecha_anuncio)
    {
        parent::__construct('viviendas', 'id');
        $this->id = $id;
        $this->tipo = $tipo;
        $this->zona = $zona;
        $this->direccion = $direccion;
        $this->ndormitorios = $ndormitorios;
        $this->precio = $precio;
        $this->tamano = $tamano;
        $this->extras = $extras;
        $this->observaciones = $observaciones;
        $this->fecha_anuncio = $fecha_anuncio;
    }

    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    public function crear()
    {

        try {
            $sql = "INSERT INTO viviendas(tipo, zona, direccion, ndormitorios, precio, tamano, extras, observaciones) VALUES(:tipo , :zona, :direccion, :ndormitorios, :precio, :tamano, :extras, :observaciones)";
            $consulta = $this->conexion->prepare($sql);

            $consulta->bindParam(":tipo", $this->tipo);
            $consulta->bindParam(":zona", $this->zona);
            $consulta->bindParam(":direccion", $this->direccion);
            $consulta->bindParam(":ndormitorios", $this->ndormitorios);
            $consulta->bindParam(":precio", $this->precio);
            $consulta->bindParam(":tamano", $this->tamano);
            $consulta->bindParam(":extras", $this->extras);
            $consulta->bindParam(":observaciones", $this->observaciones);


            $consulta->execute();
            echo "Vivienda creada con exito";
            return true;

        } catch (PDOException $e) {
            if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
                echo "Error: id ya existente.";
            } else {
                echo "Error: " . $e /* ->getMessage() */;
            }
            echo "No se ha creado la vivienda correctamente";
            return false;
        }
    }

    public function actualizar()
    {
        $sql = "UPDATE viviendas SET tipo = :tipo, zona = :zona, direccion = :direccion, ndormitorios = :ndormitorios, precio = :precio, tamano = :tamano, extras = :extras, observaciones = :observaciones, fecha_anuncio = :fecha_anuncio WHERE id = :id";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(":id", $this->id);
        $consulta->bindParam(":tipo", $this->tipo);
        $consulta->bindParam(":zona", $this->zona);
        $consulta->bindParam(":direccion", $this->direccion);
        $consulta->bindParam(":ndormitorios", $this->ndormitorios);
        $consulta->bindParam(":precio", $this->precio);
        $consulta->bindParam(":tamano", $this->tamano);
        $consulta->bindParam(":extras", $this->extras);
        $consulta->bindParam(":observaciones", $this->observaciones);
        $consulta->bindParam(":fecha_anuncio", $this->fecha_anuncio);


        $consulta->execute();
    }


    public function alquilar($id)
    {
        echo "Se han alquilado " . $_COOKIE["numeroAlquileres"] . "viviendas";
    }

}
