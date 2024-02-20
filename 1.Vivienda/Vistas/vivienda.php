<h1>Viviendas</h1>
<link rel="stylesheet" href="style.css">

<?php

//Creo una adopción "dummy" para poder ver todas las adopciones
$viviendaDummy = new Vivienda(10000, "Piso", "Valdelasfuentes", "C/Mediocre", 3, "400000€", "100m2", "Garaje", "Nada", "2020-04-09");

$viviendas = $viviendaDummy->obtieneTodos();

foreach ($viviendas as $vivienda) {

    echo '<form action="" method="post" class="form-viviendas"><input type="hidden" name="action" value="alquilar">';
    echo '<label for="id">ID:</label>
    <input type="number" name="id" value="' . $vivienda->id . '" readonly>
    <br><label for="tipo">Tipo:</label>
    <select class="" name="tipo" id="tipo_vivienda">
    <option selected hidden>' . $vivienda->tipo . '</option>
        <option value="Piso">Piso</option>
        <option value="Adosado">Adosado</option>
        <option value="Chalet">Chalet</option>
        <option value="Casa">Casa</option>
    </select>
    <br><label for="zona">Zona:</label>
    <select class="" name="zona" id="zona">
        <option selected hidden>' . $vivienda->zona . '</option>
        <option value="Centro">Centro</option>
        <option value="Norte">Norte</option>
        <option value="Sur">Sur</option>
        <option value="Este">Este</option>
        <option value="Oeste">Oeste</option>
    </select>
    <br><label for="direccion">Direccion:</label>
    <input type="text" name="direccion" value="' . $vivienda->direccion . '">
    <br><label for="ndormitorios">N. Dormitorios:</label>
    <select class="" name="ndormitorios" id="ndormitorios">
        <option selected hidden>' . $vivienda->ndormitorios . '</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5 o más">5 o más</option>
    </select>
    <br><label for="precio">Precio:</label>
    <input type="text" name="precio" value="' . $vivienda->precio . '">
    <br><label for="tamano">Tamaño:</label>
    <input type="text" name="tamano" value="' . $vivienda->tamano . '"> 
    <br><label for="extras">Extras:</label>
    <input type="text" name="extras" value="' . $vivienda->extras . '"> 
    <br><label for="observaciones">Observaciones:</label>
    <input type="text" name="observaciones" value="' . $vivienda->observaciones . '"> 
    <br><label for="fecha_anuncio">Fecha Anuncio:</label>
    <input type="date" name="fecha_anuncio" value="' . $vivienda->fecha_anuncio . '"> 
    
    <button class="btn-form-actualizar" type="submit" value="Alquilar">Alquilar</button>';

    echo '</form></div>';
}


?>