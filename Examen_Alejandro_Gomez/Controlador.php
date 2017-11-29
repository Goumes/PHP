<?php
require_once "BuscarInformacion.php";
require_once "GuardarInformacion.php";
require_once "MostrarResultado.php";
require_once "Producto.php";

/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 29/11/17
 * Time: 8:52
 */
class Controlador
{
    public function getTodosProductos()
    {
        $buscarInformacion = new BuscarInformacion();
        $mostrarResultado = new MostrarResultado();

        $result = $buscarInformacion->buscarTodosElementos();

        $mostrarResultado->mostrarResultadoTodo ($result);
    }

    public function insertarProducto ($value1, $value2, $value3, $value4)
    {
        $mostrarResultado = new MostrarResultado();
        $guardarInformacion = new GuardarInformacion ();

        //if ($url1->equals ("productos"))
        //{
            $guardarInformacion ->insertarProducto ($value1, $value2, $value3, $value4);
            $mostrarResultado->mostrarResultadoInsert($value1, $value2, $value3, $value4);
        //}
    }

    public function buscarProducto ($url2)
    {
        $producto = new Producto();
        $buscarInformacion = new BuscarInformacion();
        $mostrarResultado = new MostrarResultado();

        $producto = $buscarInformacion->buscarElemento($url2);

        $mostrarResultado->mostrarResultadoSolo ($producto);
    }
}