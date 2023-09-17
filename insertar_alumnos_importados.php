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
        $sql = "INSERT INTO Alumnos (Matricula, Nombre, ApellidoPaterno, ApellidoMaterno, Grupo, Email, Celular, FechaNacimiento)
                VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]')";

        if ($conexion->query($sql) === TRUE) {
            echo "Nuevo registro creado con éxito<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error . "<br>";
        }
    }

    $conexion->close();
}
?>
