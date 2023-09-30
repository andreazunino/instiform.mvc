<?php
require_once('curso.php');
class Curso {
    private $nombre;
    private $id;

    public function __construct($nombre, $id) {
        $this->nombre = $nombre;
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

}