<?php

/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 29/11/17
 * Time: 11:00
 */
class Producto
{
    private $nombre;
    private $cod;
    private $precio;
    private $descripcion;

    public function get_nombre(){
        return $this->nombre;
    }

    public function set_nombre($nombre1) {
    $this->nombre = $nombre1;
    }

    public function get_cod(){
        return $this->cod;
    }

    public function set_cod($cod1) {
        $this->cod = $cod1;
    }

    public function get_precio(){
        return $this->precio;
    }

    public function set_precio($precio1) {
        $this->precio = $precio1;
    }

    public function get_descripcion(){
        return $this->descripcion;
    }

    public function set_descripcion($descripcion1) {
        $this->descripcion = $descripcion1;
    }
}