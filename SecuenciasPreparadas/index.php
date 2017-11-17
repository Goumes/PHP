<?php
require_once "Database.php";
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 10/11/17
 * Time: 9:30
 */


$db = Database::getInstance();
$mysqli = $db->getConnection();
$nombreEntrada = "pepe";
$apellidoEntrada = "java";

if ($stmt = $mysqli->prepare("SELECT ID, Nombre FROM Usuarios WHERE Nombre = ? AND Apellidos = ?")) {
    $stmt->bind_param('ss', $nombreEntrada, $apellidoEntrada);
    $stmt->execute();
// Vinculamos variables a columnas
    $stmt->bind_result($ID, $nombre);
// Obtenemos los valores
    while ($stmt->fetch()) {
        printf("%s %s\n", $ID, $nombre . "\n");
    }
// Cerramos la sentencia preparada
    $stmt->close();
}