<?php
require_once "Controlador.php";
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 29/11/17
 * Time: 8:55
 */

$controlador = new Controlador();

$verbo = $_POST['verb'];
$url1 = $_POST['url1'];
$url2 = $_POST['url2'];
$url3 = $_POST['url3'];
$body1 = $_POST['body1'];
$body2 = $_POST['body2'];
$body3 = $_POST['body3'];
$body4 = $_POST['body4'];

$value4 = $_POST['value4'];

if ($body1 == "cod")
{
    $value1 = $_POST['value1'];
}

if ($body2 == "descripcion")
{
    $value2 = $_POST['value2'];
}

if ($body3 == "nombre")
{
    $value3 = $_POST['value3'];
}

if ($body4 == "precio")
{
    $body4 = $_POST['body4'];
}

if ($verbo == "get"
    && $url1 == "producto")
{
    if ($url2 != null && $url2 != "") //Comprobamos si hay un segundo valor, es decir, si estás tratando con un producto individual
    {
        $controlador->buscarProducto($url2);
    }

    else
    {
        $controlador->getTodosProductos();
    }
}

else if ($verbo == "put"
    && $value1 != null
    && $value2 != null
    && $value3 != null
    && $value4 != null
    && $url1 == "producto")
{
    $controlador->insertarProducto ($value1, $value2, $value3, $value4);
}