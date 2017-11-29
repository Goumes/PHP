<?php
require_once "Database.php";
require_once "Producto.php";
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 29/11/17
 * Time: 8:54
 */
class MostrarResultado
{
    public function mostrarResultadoTodo($result)
    {
        if ($result->num_rows > 0)
        {
            echo 'HTTP/1.1 200 OK';
            echo '<br/>';
            echo 'Content-Type: text/html';
            echo '<br/>';
            echo '<br/>';
            echo '<table border=\"1\">';
            echo '<tr>';
            echo '<td>' . \Constantes_DB\tabla_1::COD . '</td>';
            echo '<td>' . \Constantes_DB\tabla_1::DESCRIPCION . '</td>';
            echo '<td>' . \Constantes_DB\tabla_1::NOMBRE . '</td>';
            echo '<td>' . \Constantes_DB\tabla_1::PRECIO . '</td>';
            echo '</tr>';

            while ($row = $result->fetch_assoc())
            {
                echo '<tr>';
                echo '<td>' . $row[\Constantes_DB\tabla_1::COD] . '</td>';
                echo '<td>' . $row[\Constantes_DB\tabla_1::DESCRIPCION] . '</td>';
                echo '<td>' . $row[\Constantes_DB\tabla_1::NOMBRE] . '</td>';
                echo '<td>' . $row[\Constantes_DB\tabla_1::PRECIO] . '</td>';
                echo '</tr>';
            }
        }
    }

    public function mostrarResultadoInsert ($value1, $value2, $value3, $value4)
    {
        echo 'HTTP/1.1 201 Created';
        echo '<br/>';
        echo 'Content-Type: text/html';
        echo '<br/>';
        echo 'Location: http://www.paginaExamen.com/producto/';
        echo 'ufdf2'; //esto es simplemente una id inventada simulando la generación automática de id
        echo '<br/>';
        echo '<br/>';
        echo 'COD: ';
        echo $value1;
        echo '<br/>';
        echo 'Descripcion: ';
        echo $value2;
        echo '<br/>';
        echo 'Nombre: ';
        echo $value3;
        echo '<br/>';
        echo 'Precio: ';
        echo $value4;
    }

    public function mostrarResultadoSolo (Producto $producto)
    {
        echo 'HTTP/1.1 200 OK';
        echo '<br/>';
        echo 'Content-Type: text/html';
        echo '<br/>';
        echo '<br/>';
        echo 'Nombre: ';
        echo $producto->get_nombre();
        echo '<br/>';
        echo 'COD: ';
        echo $producto->get_cod();
        echo '<br/>';
        echo 'Descripcion: ';
        echo $producto->get_descripcion();
        echo '<br/>';
        echo 'Precio: ';
        echo $producto->get_precio();
    }
}