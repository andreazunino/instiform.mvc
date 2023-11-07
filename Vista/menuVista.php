<?php

class Vista {
    public function mostrarMenuPrincipal() {
        $opcionesMenuPrincipal = [
            "Configuración de Estudiantes",
            "Configuración de Cursos",
            "Inscribir",
            "Borrar Inscripcion"
        ];
        $this->mostrarMenu($opcionesMenuPrincipal);
    }

    public function mostrarSubMenuUsuarios() {
        $opcionesUsuarios = ["Dar de Alta", "Dar de Baja", "Modificar Datos", "Ver Datos e Inscripciones"];
        $this->mostrarMenu($opcionesUsuarios);
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
        echo "0. Salir\n";
        echo "=================================\n";
        echo "=========== Instiform ===========\n";
        echo "\n";
    }
    
}







