<?php

/*class MenuView {
    public function mostrarMenu() {
        // Lógica para mostrar el menú
    }

    public function mostrarSubMenuUsuarios() {
        // Lógica para mostrar submenú de usuarios
    }

    public function mostrarSubMenuCursos() {
        // Lógica para mostrar submenú de cursos
    }

    // Otros métodos para mostrar información al usuario
}


class Vista {
    public function mostrarMenuPrincipal() {
        echo "=========== Bienvenido ==========\n";
        echo "1. Inscribir Usuarios\n";
        echo "2. Configuracion de Usuarios\n";
        echo "3. Configuracion de Cursos\n";
        echo "0. Salir\n";
        echo "=========== Instiform ==========\n";
        echo "\n";
    }

    public function mostrarSubMenuUsuarios() {
        // Lógica para mostrar el submenú de usuarios...
    }

    public function mostrarSubMenuCursos() {
        // Lógica para mostrar el submenú de cursos...
    }

    // Otros métodos de presentación...
}*/


require_once('Modelo/estudiante.php');
require_once('Modelo/curso.php');
require_once('Modelo/gestionEstudiante.php');
require_once('Modelo/gestionCurso.php');
require_once('Controlador/menuControlador.php');

//$gestionEstudiante = new gestionEstudiante();
//$gestionCurso = new gestionCurso();



/*class Vista {
    public function mostrarMenuPrincipal() {
        echo "\n";
        echo "=========== Bienvenido ==========\n";
        echo "1. Inscribir Usuarios\n";
        echo "2. Configuración de Usuarios\n";
        echo "3. Configuración de Cursos\n";
        echo "0. Salir\n";
        echo "=========== Instiform ==========\n";
        echo "\n";
    }

    public function mostrarSubMenuUsuarios() {
        echo "\n";
        echo "========== Menú Usuario =========\n";
        echo "1. Dar de Alta Usuario\n";
        echo "2. Dar de Baja Usuario\n";
        echo "3. Modificar Datos de Usuario\n";
        echo "4. Ver Datos e Inscripciones\n";
        echo "0. Volver al Menú Principal\n";
        echo "=========== Instiform ==========\n";
        echo "\n";
    }

    public function mostrarSubMenuCursos() {
        echo "\n";
        echo "========== Menú Cursos =========\n";
        echo "1. Dar de Alta Curso\n";
        echo "2. Dar de Baja Curso\n";
        echo "3. Modificar Datos de Curso\n";
        echo "4. Listar Cursos\n";
        echo "0. Volver al Menú Principal\n";
        echo "=========== Instiform ==========\n";
        echo "\n";
    }

    public function mostrarMensajeError($mensaje) {
        echo "Error: " . $mensaje . "\n";
    }
}*/

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







