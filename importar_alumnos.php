<?php

require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" href="importar_alumnos.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar Base de Datos</title>
</head>
<body>
    <h2>Importar base de datos de alumnos</h2>

    <p>
        <strong>Nota:</strong> El formato que la biblioteca phpspreadsheet puede leer con mayor compatibilidad es el formato .xlsx (Excel 2007 y superiores). Sin embargo, también soporta una variedad de otros formatos, como .xls (Excel 5.0/95, Excel 2003), pero .xlsx es el más recomendado debido a su adopción generalizada y características extendidas.
    </p>

    <p>
        Encabezados. No es obligatorio que los nombres de las columnas en Excel coincidan con los nombres de los campos en la base de datos. En esta plataforma, la inserción en la base de datos se basa en el orden de las columnas y no en sus nombres. Sin embargo, tener encabezados que se correspondan puede hacer que el proceso sea más comprensible para cualquier persona que esté revisando el archivo Excel.
    </p>

    <div class="centrar-contenido">
    <p>Si decides ir con encabezados que coincidan, los nombres de los encabezados deberían ser:</p>
    <ul>
        <li>Matrícula</li>
        <li>Nombre</li>
        <li>Apellido paterno</li>
        <li>Apellido materno</li>
        <li>Grupo</li>
        <li>Email</li>
        <li>Celular</li>
        <li>Fecha nac</li>
    </ul>
    <p>Asegúrate de que los datos en el archivo Excel estén en el mismo orden que estos encabezados.</p>
</div>


    <p>
        Los encabezados son útiles para la referencia del usuario. En la primera fila la plataforma asume que contiene encabezados, por lo que los descarta con array_shift($rows). MySQL espera que el formato sea 'yyyy-mm-dd
    </p>

    <form action="subir_alumnos_importados.php" method="post" enctype="multipart/form-data">
        <label for="archivo">Selecciona un archivo en formato XLS:</label>
        <input type="file" name="archivo" id="archivo" accept=".xls,.xlsx">
        <button type="submit">Subir</button>
    </form>
</body>
</html>
