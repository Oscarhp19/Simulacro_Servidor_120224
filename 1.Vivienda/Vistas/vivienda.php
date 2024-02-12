<h1>Viviendas</h1>
<link rel="stylesheet" href="style.css">

<?php

//Creo una adopción "dummy" para poder ver todas las adopciones
$viviendaDummy = new Vivienda(10000, "Piso", "Valdelasfuentes", "C/Mediocre", 3, "400000€", "100m2", "Garaje", "Nada", "2020-04-09");

$viviendas = $viviendaDummy->obtieneTodos();

foreach ($viviendas as $vivienda) {
    echo "<ul>
            <li><input type='hidden' name='action' value='alquilar'>ID: $vivienda->id | Tipo: $vivienda->tipo | Zona: $vivienda->zona | Direccion: $vivienda->direccion | Número dormitorios: $vivienda->ndormitorios | Precio: $vivienda->precio | Tamaño: $vivienda->tamano <input value='Alquilar' name='alquilar' type='submit' method='post'></input></li>         
    </ul>";
}


?>