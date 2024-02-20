<?php
function mostrarCookieViviendasAlquiladas() {
    if (isset($_COOKIE['viviendas_alquiladas'])) {
        $viviendas_alquiladas = json_decode($_COOKIE['viviendas_alquiladas'], true);
        
        echo "Información de las viviendas alquiladas:";
        echo "<ul>";
        
        foreach ($viviendas_alquiladas as $id => $vivienda) {
            echo "<li>ID: " . $vivienda['id'] . "</li>";
            echo "<li>Tipo: " . $vivienda['tipo'] . "</li>";
            echo "<li>Zona: " . $vivienda['zona'] . "</li>";
            echo "<li>Dirección: " . $vivienda['direccion'] . "</li>";
            echo "<li>Número de dormitorios: " . $vivienda['ndormitorios'] . "</li>";
            echo "<li>Precio: " . $vivienda['precio'] . "</li>";
            echo "<li>Tamaño: " . $vivienda['tamano'] . "</li>";
            echo "<br>";
        }
        
        echo "</ul>";
    } else {
        echo "No hay información de viviendas alquiladas guardada en la cookie.";
    }
}

mostrarCookieViviendasAlquiladas();