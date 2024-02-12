<h1>Registro Vivienda</h1>
<link rel="stylesheet" href="style.css">

<div class="container-Formulario">
    <h2 class="h2">Registrar Vivienda</h2><br>
    <form action="" method="post" class="form">
        <input type="hidden" name="action" value="crear">
        <select class="input-login" name="tipo" id="tipo_vivienda">
            <option value="Piso">Piso</option>
            <option value="Adosado">Adosado</option>
            <option value="Chalet">Chalet</option>
            <option value="Casa">Casa</option>
        </select>
        <select class="input-login" name="zona" id="zona">
            <option value="Centro">Centro</option>
            <option value="Norte">Norte</option>
            <option value="Sur">Sur</option>
            <option value="Este">Este</option>
            <option value="Oeste">Oeste</option>
        </select>
        <input class="input-login" type="text" placeholder="Dirección" method="post" name="direccion">
        <select class="input-login" name="ndormitorios" id="ndormitorios">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5 o más">5 o más</option>
        </select>
        <input class="input-login" type="decimal" placeholder="Precio" method="post" name="precio">
        <input class="input-login" type="decimal" placeholder="Tamaño" method="post" name="tamano">
        <select class="input-login" name="extras" id="extras">
            <option value="Piscina">Piscina</option>
            <option value="Jardín">Jardín</option>
            <option value="Garaje">Garaje</option>
        </select>
        <input class="input-login" type="text" placeholder="Observaciones" method="post" name="observaciones">
        <button class="button" type="submit" method="post" value="Crear" name="btnCrear">Crear<span></span></button>
    </form>
</div>

</form>