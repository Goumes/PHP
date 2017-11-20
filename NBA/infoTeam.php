<?php
require_once "Database.php";
require_once "tabla1.php";
require_once "tabla2.php";
/**
 * Created by PhpStorm.
 * User: aleja
 * Date: 19/11/2017
 * Time: 20:47
 */
$db = Database::getInstance();
$mysqli = $db->getConnection();

$nombreEquipo = $_POST ['nameTeam'];

if (isset($_POST ['playerName']))
{
    $delete = $_POST['playerName'];
    $sql_query2 = "DELETE FROM ". \Constantes_DB\tabla2::TABLE_NAME . " WHERE " . \Constantes_DB\tabla2::NOMBRE . "= ?";
    $stmt = $mysqli->prepare($sql_query2);
    $stmt->bind_param('s',$delete);
    $stmt->execute();
}

$sql_query = "SELECT ". \Constantes_DB\tabla2::NOMBRE . " , "
    . \Constantes_DB\tabla2::APELLIDOS . " , "
    . \Constantes_DB\tabla2::EDAD . " , "
    . \Constantes_DB\tabla2::FOTO
    ." FROM ". \Constantes_DB\tabla2::TABLE_NAME
    ." WHERE ".\Constantes_DB\tabla2::NOMBRE_EQUIPO. " = ?";

if ($stmt = $mysqli->prepare($sql_query)) {

    $stmt->bind_param('s', $nombreEquipo);

    $stmt->execute();

    $stmt->bind_result($nombre, $apellidos, $edad, $foto);


    echo '<table border=\"1\">';
    echo '<tr>';
    echo '<td/>';
    echo '<td>' . \Constantes_DB\tabla2::NOMBRE . '</td>';
    echo '<td>' . \Constantes_DB\tabla2::APELLIDOS . '</td>';
    echo '<td>' . \Constantes_DB\tabla2::EDAD . '</td>';
    echo '<td>' . \Constantes_DB\tabla2::FOTO . '</td>';
    echo '<td/>';
    echo '</tr>';
    // output data of each row
    while ($stmt->fetch()) {
        echo '<tr>';
        echo '<form action = "Formulario2.php" method ="post">';
        echo '<input type="hidden" name="playerName" value="' . $nombre . '"></input>';
        echo '<input type="hidden" name="nameTeam" value="' . $_POST ['nameTeam'] . '"></input>';
        echo '<td><input type="submit" name="editPlayer" value="Editar"/></td>';
        echo '</form>';
        echo '<td>' . $nombre . '</td>';
        echo '<td>' . $apellidos . '</td>';
        echo '<td>' . $edad . '</td>';
        echo '<td>' . $foto . '</td>';
        echo '<form action = "" method ="post">';
        echo '<input type="hidden" name="playerName" value="' . $nombre . '"></input>';
        echo '<input type="hidden" name="nameTeam" value="' . $_POST ['nameTeam'] . '"></input>';
        echo '<td><input type="submit" name="deletePlayer" value="Borrar" /></td>';
        echo '</form>';

        echo '</tr>';
    }
    echo '</table>';
    echo '<br/>';

    echo '<form action = "formulario2.php" method = "post">';
    echo '<input type="submit" value="Añadir un jugador"/>';
    echo '</form>';
}