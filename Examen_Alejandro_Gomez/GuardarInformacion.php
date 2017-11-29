<?php
require_once "Database.php";
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 29/11/17
 * Time: 8:53
 */
class GuardarInformacion
{
    public function insertarProducto ($value1, $value2, $value3, $value4)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();

        $sql_query = "INSERT INTO ".\Constantes_DB\tabla_1::TABLE_NAME. " ("
            .\Constantes_DB\tabla_1::COD.
            ", ".\Constantes_DB\tabla_1::DESCRIPCION.
            ", ".\Constantes_DB\tabla_1::NOMBRE.
            ", ".\Constantes_DB\tabla_1::PRECIO.") VALUES (?,?,?,?)";
        $stmt = $mysqli->prepare($sql_query);
        $stmt->bind_param('issd',$value1, $value2, $value3, $value4);
        $stmt->execute();
    }
}