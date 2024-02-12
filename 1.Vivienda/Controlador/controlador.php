<title>Inmobiliaria</title>

<body>
    <?php


    include_once("C:/xampp/htdocs/2EV/Simulacro/1.Vivienda/Modelos/Vivienda.php");


    session_start();


    include "C:/xampp/htdocs/2EV/Simulacro/1.Vivienda/Vistas/menu.php";

    const DEFAULT_VIEW = "vivienda";

    $views = array("vivienda" => "C:/xampp/htdocs/2EV/Simulacro/1.Vivienda/Vistas/vivienda.php", "registrar-vivienda" => "C:/xampp/htdocs/2EV/Simulacro/1.Vivienda/Vistas/registrar-vivienda.php");




    //Obteniendo la vista que está el usuario o quiere estar
    //Si da algún botón se cambia la vista activa por esa
    if (isset($_POST["view"]))
        $_SESSION["activeView"] = $_POST["view"];
    //Si el usuario no da a ningún botón ni lo le había dado antes la vista activa es la default
    else if (!isset($_SESSION["activeView"])) {
        $_SESSION["activeView"] = DEFAULT_VIEW;
    }
    //En otro caso la vista activa es la que ya está almacenada en la sesión
    

    if (isset($_POST["action"])) {
        if ($_POST["action"] == "crear") {
            if ($_SESSION["activeView"] == "registrar-vivienda") {

                $newVivienda = new Vivienda($_POST['id'], $_POST['tipo'], $_POST['zona'], $_POST['direccion'], $_POST['ndormitorios'], $_POST['precio'], $_POST['tamano'], $_POST['extras'], $_POST['observaciones'], null /*, $_POST['fecha_anuncio'] */);
                $newVivienda->crear();

            }
        }



        if ($_POST["action"] == "alquilar") {
            if ($_SESSION["activeView"] == "vivienda") {
                $alquileres = isset($_COOKIE['alquileres']) ? json_decode($_COOKIE['alquileres']) : array();

                $alquileres[] = date('d-m-y h:i:s');
                foreach ($alquileres as $alquiler => $hora) {
                    echo "alquiler: " . $alquiler . " Hora: " . $hora . "<br>";
                }
                setcookie('numeroAlquileres', json_encode($alquileres), time() + 15);
                $_COOKIE["numeroAlquileres"]++;
                $viviendaDummy->alquilar($_POST['id']);

            }
        }
    }



    include($views[$_SESSION["activeView"]]);
    ?>

</body>