<?php

include_once("Crud.php");

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
            $sql = "INSERT INTO viviendas(tipo, zona, direccion, ndormitorios, precio, tamano, extras, observaciones) VALUES (:tipo , :zona, :direccion, :ndormitorios, :precio, :tamano, :extras, :observaciones)";
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
                echo "Error: " . $e->getMessage();
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


/*     public function alquilar($id)
{
    session_start();
    $sql = "SELECT id, tipo, zona, direccion, ndormitorios, precio, tamano FROM viviendas WHERE id = $id";
    $consulta = $this->conexion->prepare($sql);
    $consulta->execute();
    
    $result = $consulta->get_result(); // Assuming $consulta is a mysqli_stmt object
    
    if ($result->num_rows > 0) {
        // Almacenar los resultados en un array
        $vivienda = $result->fetch_assoc();
    } else {
        echo "No se encontraron resultados para el ID proporcionado.";
    }
    
    $vivienda_json = json_encode($vivienda);
    
    setcookie("viviendas_alquiladas", $vivienda_json, time() + (86400 * 30), "/");
} */




function alquilar($id) {

    try {
   
        
        // Preparar la consulta SQL con un marcador de posición
        $consulta = $this->conexion->prepare("SELECT id, tipo, zona, direccion, ndormitorios, precio, tamano FROM viviendas WHERE id = :id");
        
        // Asignar el valor del parámetro ID y ejecutar la consulta
        $consulta->execute([':id' => $id]);
        
        // Obtener la fila de resultados
        $vivienda = $consulta->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontraron resultados
        if ($vivienda) {
            // Obtener el array actual de viviendas alquiladas de la cookie
            $viviendas_alquiladas = isset($_COOKIE['viviendas_alquiladas']) ? json_decode($_COOKIE['viviendas_alquiladas'], true) : [];

            // Agregar la vivienda al array de viviendas alquiladas
            $viviendas_alquiladas[$id] = $vivienda;

            // Guardar el array actualizado en la cookie
            setcookie('viviendas_alquiladas', json_encode($viviendas_alquiladas), time() + (86400 * 30), "/"); // Cookie válida por 30 días
            
            // Confirmar al usuario que la vivienda ha sido alquilada y la información se ha guardado en la cookie
            echo "La vivienda ha sido alquilada correctamente y la información se ha guardado en la cookie.";
        } else {
            // Informar al usuario que no se encontró ninguna vivienda con el ID especificado
            echo "No se encontró ninguna vivienda con el ID especificado.";
        }

    } catch (PDOException $e) {
        // Capturar y mostrar cualquier error ocurrido durante la conexión o consulta a la base de datos
        echo "Error al conectar con la base de datos: " . $e->getMessage();
    }
}

}
