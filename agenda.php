<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Agenda de contactos</title>
    </head>

    <body>

    <!------------------------------------------LOGICA PHP--------------------------------------------------->
        <?php
        if (isset($_GET['agenda'])) //Aquí isset nos permite saber si una variable está definida
            $agenda = $_GET['agenda']; //Al estar definida, le pasamos el valor a agenda (agenda)
        else
            $agenda = array(); // Si no está creada, la creamos como array vacío.
        
        
        if (isset($_GET['submit'])) //Pregunta si el formulario ha sido enviado.
        {   //Filter input: para obtener la variable externa específica por nombre y filtrarla.
            $nuevo_nombre = filter_input(INPUT_GET,'nombre');  //Pasamos valor nombre a variable nuevo nombre
            $nuevo_telefono = filter_input(INPUT_GET,'telefono'); //Lo mismo con teléfono

            //Excepciones (campos vacíos)
            if (empty($nuevo_nombre)){
                echo "<p style='color:red'>Por favor, introduce un nombre</p><br />";
            }
            elseif (empty($nuevo_telefono)){
                echo "<p style='color:red'>Por favor, introduce un teléfono</p><br />";
                unset($agenda[$nuevo_nombre]); //Unset elimina la variable
            }
            else{
                //Todo correcto. El valor del nuevo nombre de la agenda es el teléfono proporcionado
                $agenda[$nuevo_nombre] = $nuevo_telefono;
            }
        }
        ?>


<!-----------------------------------------FORMULARIO-------------------------------------------------->
        <h2>Nuevo contacto</h2>

        <form>
            <!--Bucle foreach -->
            <div style="align-items: left">
                <?php
                foreach ($agenda as $nom => $telf) {
                    echo '<input type="hidden" name="agenda[' . $nom . ']" ';
                    echo 'value="' . $telf . '"/>';
                }
                ?>
                <label>Nombre:<input type="text" name="nombre"/></label><br />
                <label>Teléfono:<input type="number" name="telefono"/></label><br />
                <input type="submit" name='submit' value="Ejecutar"/><br />
            </div>
        </form>
        <br />

        <!-----------------------------------------AGENDA------------------------------------------------>
        <h2>Agenda</h2>
        <?php
        if (count($agenda) == 0){
            echo "<p>No hay contactos en la agenda.</p>";
        }
        else{
            echo "<ul>";
            foreach ($agenda as $nom => $telf) {
                echo "<li>" . $nom . ': ' . $telf . "</li>";
            }
            echo "</ul>";
        }
        ?>        
    </body>
</html>