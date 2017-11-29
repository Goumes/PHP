<?php
require_once "Database.php";
require_once "tabla_1.php";
require_once "Producto.php";
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 29/11/17
 * Time: 8:54
 */
class BuscarInformacion
{
    public function buscarTodosElementos()
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();

        $sql_query = "SELECT " . \Constantes_DB\tabla_1::NOMBRE . " , "
            . \Constantes_DB\tabla_1::DESCRIPCION . ", "
            . \Constantes_DB\tabla_1::PRECIO . ", "
            . \Constantes_DB\tabla_1::COD
            . " FROM " . \Constantes_DB\tabla_1::TABLE_NAME;

        $result = $mysqli->query($sql_query);

        return $result;
    }

    public function buscarElemento ($url2)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $producto = new Producto();

        /*
        $sql_query = "SELECT " . \Constantes_DB\tabla_1::NOMBRE . " , "
            . \Constantes_DB\tabla_1::DESCRIPCION . ", "
            . \Constantes_DB\tabla_1::PRECIO . ", "
            . \Constantes_DB\tabla_1::COD
            . " FROM " . \Constantes_DB\tabla_1::TABLE_NAME
            . "WHERE ". \Constantes_DB\tabla_1::COD. " = ?";

        //Hay algo mal con esta query pero no me da tiempo a encontrar el fallo
        //Si lo encontrara usaría la query comentada, porque es más segura y eficiente*/

        $sql_query = "SELECT nombre, descripcion, precio, cod FROM productos WHERE cod = ?";

        $stmt = $mysqli->prepare($sql_query);
        $stmt->bind_param('s',$url2);
        $stmt->execute();
        $stmt->bind_result($nombre, $descipcion, $precio, $cod);

        while ($stmt->fetch())
        {
            $producto->set_cod($cod);
            $producto->set_descripcion($descipcion);
            $producto->set_precio($precio);
            $producto->set_nombre($nombre);
        }

        return ($producto);
    }
}