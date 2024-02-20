<title>Inmobiliaria</title>

<body>
    <?php


    include_once("Modelos/Vivienda.php");


    session_start();


    include "Vistas/menu.php";

    const DEFAULT_VIEW = "vivienda";

    $views = array("vivienda" => "Vistas/vivienda.php", "registrar-vivienda" => "Vistas/registrar-vivienda.php", "mostrar-alquileres" => "Vistas/mostrar-alquileres.php");

    $viviendaDummy = new Vivienda(10000, "Piso", "Valdelasfuentes", "C/Mediocre", 3, "400000€", "100m2", "Garaje", "Nada", "2020-04-09");


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

                $extras = isset($_POST["extras"]) ? implode(",", $_POST["extras"]) : "";

                $newVivienda = new Vivienda("", $_POST['tipo'], $_POST['zona'], $_POST['direccion'], $_POST['ndormitorios'], $_POST['precio'], $_POST['tamano'], $extras, $_POST['observaciones'], "");
                $newVivienda->crear();

            }
        }

        if ($_POST["action"] == "alquilar") {
            if ($_SESSION["activeView"] == "vivienda") {

                $viviendaDummy->alquilar($_POST['id']);

            }
        }

        
    }



    include($views[$_SESSION["activeView"]]);
    ?>

</body>