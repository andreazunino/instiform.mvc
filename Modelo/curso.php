<?php

class Curso {
    private $nombre;
    private $id;

    public function __construct($id, $nombre) {
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
