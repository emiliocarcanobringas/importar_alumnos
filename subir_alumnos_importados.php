
<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

function insertar_datos($ruta_archivo) {
    $spreadsheet = IOFactory::load($ruta_archivo);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    $servidor = "localhost";
    $usuario = "root";
    $password = "posgrado123";
    $base_datos = "gakko_kanri";

    $conexion = new mysqli($servidor, $usuario, $password, $base_datos);

    if ($conexion->connect_error) {
        die("Error al conectar: " . $conexion->connect_error);
    }

    // Quitamos la primera fila si tiene los encabezados
    array_shift($rows);

    foreach ($rows as $row) {
        $sql = "INSERT INTO alumnos (Matricula, Nombre, ApellidoPaterno, ApellidoMaterno, Grupo, Email, Celular, FechaNacimiento)
                VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]')";

        if ($conexion->query($sql) === TRUE) {
            echo "Nuevo registro creado con éxito<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error . "<br>";
        }
    }

    $conexion->close();
}

// Proceso de subida de archivo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $directorio_temporal = $_FILES["archivo"]["tmp_name"];
    $nombre_archivo = basename($_FILES["archivo"]["name"]);
    $ruta_destino = "uploads/" . $nombre_archivo;

    if (move_uploaded_file($directorio_temporal, $ruta_destino)) {
		if ($_FILES["archivo"]["error"] !== UPLOAD_ERR_OK) {
    die("Error al subir archivo. Código de error: " . $_FILES["archivo"]["error"]);
}

        echo "El archivo ". $nombre_archivo . " ha sido subido con éxito.<br>";

        // Procesar e insertar datos
        insertar_datos($ruta_destino);

    } else {
        echo "Ocurrió un error al subir el archivo.<br>";
        
        // Detalles del error
        echo "Error: " . $_FILES["archivo"]["error"] . "<br>";
    }
}

