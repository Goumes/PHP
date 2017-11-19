<?php
require_once "Database.php";
require_once "tabla1.php";
require_once "tabla2.php";
/**
 * Created by PhpStorm.
 * User: aleja
 * Date: 19/11/2017
 * Time: 12:51
 */
//Listar todos los equipos y dar la opción de añadir (Formulario de otra página), eliminar y ver información de cada equipo (En otra página).

$db = Database::getInstance();
$mysqli = $db->getConnection();

if (isset($_POST ['nameTeam']))
{
    $delete = $_POST['nameTeam'];
    $sql_query2 = "DELETE FROM ". \Constantes_DB\tabla1::TABLE_NAME . " WHERE " . \Constantes_DB\tabla1::NOMBRE . "= ?";
    $stmt = $mysqli->prepare($sql_query2);
    $stmt->bind_param('s',$delete);
    $stmt->execute();
}

else if (isset($_POST ['nombreEquipo']) && isset($_POST ['numeroJugadores']))
{
    $equipo = $_POST ['nombreEquipo'];
    $numero = $_POST ['numeroJugadores'];
    $sql_query3 = "INSERT INTO ".\Constantes_DB\tabla1::TABLE_NAME. " (".\Constantes_DB\tabla1::NOMBRE.", ".\Constantes_DB\tabla1::N_JUGADORES.") VALUES (?,?)";
    //$sql_query3 = "INSERT INTO Equipos (Nombre, numeroJugadores) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql_query3);
    $stmt->bind_param('ss',$equipo, $numero);
    $stmt->execute();
}

$sql_query = "SELECT ". \Constantes_DB\tabla1::NOMBRE . " , "
    . \Constantes_DB\tabla1::N_JUGADORES
    ." FROM ". \Constantes_DB\tabla1::TABLE_NAME ;

$result = $mysqli->query($sql_query);


if ($result->num_rows > 0)
{
    echo '<table border=\"1\">';
    echo '<tr>';
    echo '<td/>';
    echo '<td>' . \Constantes_DB\tabla1::NOMBRE . '</td>';
    echo '<td>' . \Constantes_DB\tabla1::N_JUGADORES . '</td>';
    echo '<td/>';
    echo '</tr>';
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<form action = "infoTeam.php" method ="post">';
        echo '<input type="hidden" name="nameTeam" value="'.$row[\Constantes_DB\tabla1::NOMBRE].'"></input>';
        echo '<td><input type="submit" name="infoTeam" value="Info"/></td>';
        echo '</form>';
        echo '<td>' . $row[\Constantes_DB\tabla1::NOMBRE] . '</td>';
        echo '<td>' . $row[\Constantes_DB\tabla1::N_JUGADORES] . '</td>';
        echo '<form action = "" method ="post">';
        echo '<input type="hidden" name="nameTeam" value="'.$row[\Constantes_DB\tabla1::NOMBRE].'"></input>';
        echo '<td><input type="submit" name="deleteItem" value="Borrar" /></td>';
        echo '</form>';

        echo '</tr>';
    }
    echo '</table>';
    echo '<br/>';

    echo '<form action = "formulario.php" method = "post">';
    echo '<input type="submit" value="Añadir un equipo"/>';
    echo '</form>';

}

/*
if ($stmt = $mysqli->prepare("SELECT Nombre, numeroJugadores FROM Equipos")) {
    $stmt->execute();
// Vinculamos variables a columnas
    $stmt->bind_result($nombre, $n_jugadores);
// Obtenemos los valores
    while ($stmt->fetch()) {
        printf("%s %s\n", $nombre, $n_jugadores );
    }
// Cerramos la sentencia preparada
    $stmt->close();

}
*/