<?php

require_once "Database.php";
require_once "tabla1.php";
require_once "tabla2.php";

//We also could have done:
//use \Constantes_DB\tabla1;
// And now we can use the class without preceding it with the namespace:
// echo tabla1::COD;

$db = Database::getInstance();
$mysqli = $db->getConnection();

$sql_query2 = "INSERT INTO". \Constantes_DB\tabla1::TABLE_NAME . "(".\Constantes_DB\tabla1::ID . ", " . \Constantes_DB\tabla1::NOMBRE .")"
    . "VALUES ('10', 'pepe')";

if ($mysqli->query ($sql_query2) === TRUE)
{
    echo "insert hecho";
}

else
{
    echo "la has liao paco";
}

$sql_query = "SELECT U.". \Constantes_DB\tabla1::NOMBRE . " , U."
    . \Constantes_DB\tabla1::APELLIDOS . " , U."
    . \Constantes_DB\tabla1::FNAC . " , U."
    . \Constantes_DB\tabla1::ALIAS . " , U."
    . \Constantes_DB\tabla1::ID . " , M."
    . \Constantes_DB\tabla2::ID . " AS ID2 , M."
    . \Constantes_DB\tabla2::ID_USUARIO . " , M."
    . \Constantes_DB\tabla2::NOMBRE . " AS Nombre2 , M."
    . \Constantes_DB\tabla2::RAZA . " "
    ." FROM ". \Constantes_DB\tabla1::TABLE_NAME ." AS U "
    ." INNER JOIN "
    .\Constantes_DB\tabla2::TABLE_NAME." AS M "
    ." ON U.ID = M.ID_Usuarios ";


$result = $mysqli->query($sql_query);

if ($result->num_rows > 0) {
    echo '<table border=\"1\">';
    echo '<tr>';
    echo '<td>'. \Constantes_DB\tabla1::ID .'</td>';
    echo '<td>'. \Constantes_DB\tabla1::NOMBRE  .'</td>';
    echo '<td>'. \Constantes_DB\tabla1::APELLIDOS  .'</td>';
    echo '<td>'. \Constantes_DB\tabla1::FNAC .'</td>';
    echo '<td>'. \Constantes_DB\tabla1::ALIAS .'</td>';
    echo '<td>'. \Constantes_DB\tabla2::ID .'</td>';
    echo '<td>'. \Constantes_DB\tabla2::ID_USUARIO .'</td>';
    echo '<td>'. \Constantes_DB\tabla2::NOMBRE .'</td>';
    echo '<td>'. \Constantes_DB\tabla2::RAZA .'</td>';
    echo '</tr>';
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'. $row[\Constantes_DB\tabla1::ID] .'</td>';
        echo '<td>'. $row[\Constantes_DB\tabla1::NOMBRE]  .'</td>';
        echo '<td>'. $row[\Constantes_DB\tabla1::APELLIDOS]  .'</td>';
        echo '<td>'. $row[\Constantes_DB\tabla1::FNAC] .'</td>';
        echo '<td>'. $row[\Constantes_DB\tabla1::ALIAS] .'</td>';
        echo '<td>'. $row['ID2'] .'</td>';
        echo '<td>'. $row[\Constantes_DB\tabla2::ID_USUARIO] .'</td>';
        echo '<td>'. $row['Nombre2'] .'</td>';
        echo '<td>'. $row[\Constantes_DB\tabla2::RAZA] .'</td>';

        echo '</tr>';
    }
    echo '</table>';

}