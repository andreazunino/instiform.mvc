<?php

class Vista {
    public function mostrarMenuPrincipal() {
        $opcionesMenuPrincipal = [
            "Administración de Estudiantes",
            "Administración de Cursos",
            "Administración de Inscripciones"
        ];
        $this->mostrarMenu($opcionesMenuPrincipal);
    }

    public function mostrarSubMenuUsuarios() {
        $opcionesUsuarios = ["Dar de Alta", "Dar de Baja", "Modificar Datos", "Ver Datos e Inscripciones"];
        $this->mostrarMenu($opcionesUsuarios);
    }

    public function mostrarSubMenuInscripciones() {
        $opcionesInscripciones = ["Inscribir", "Borrar Inscripcion", "Listar Inscripciones"];
        $this->mostrarMenu($opcionesInscripciones);
    }

    public function mostrarSubMenuCursos() {
        $opcionesCursos = ["Dar de Alta", "Dar de Baja", "Modificar Datos", "Listar"];
        $this->mostrarMenu($opcionesCursos);
    }

    public function mostrarMensajeError($mensaje) {
        echo "Error: " . $mensaje . "\n";
    }

      private function mostrarMenu(array $opciones) {
        echo "=========== Bienvenido ==========\n";
        echo "============= Menú ==============\n";
        foreach ($opciones as $index => $opcion) {
            printf("%-2s. %s\n", $index + 1, $opcion);
        }
        echo "0 . Salir\n";
        echo "=================================\n";
        echo "=========== Instiform ===========\n";
        echo "\n";
    }
    
}







