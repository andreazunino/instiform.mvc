<?php

require_once('Estudiante.php');
require_once('Curso.php');
require_once('gestionEstudiante.php');
require_once('../Modelo/gestionCurso.php');
require_once('../Vista/menuVista.php');

class Controlador {
    private $gestionEstudiante;
    private $gestionCurso;
    private $vista;

    public function __construct($gestionEstudiante, $gestionCurso, $vista) {
        $this->gestionEstudiante = $gestionEstudiante;
        $this->gestionCurso = $gestionCurso;
        $this->vista = $vista;
    }

    public function run() {
        // Lógica de tu aplicación
        $opcionMenu = readline("Ingrese una opción: ");
        // Procesar la opción del menú usando el modelo
        $this->menu($opcionMenu);
    }

    public function menu($opcionMenu) {
        switch ($opcionMenu) {
            case '1':
                $this->subMenuUsuarios();
                break;
            case '2':
                $this->subMenuCursos();
                break;
            case '0':
                // Lógica para la opción 0 (Salir)...
                // Puedes mostrar un mensaje de despedida con la vista y luego salir del programa.
                break;
            default:
                // Opción no válida. Mostrar un mensaje de error con la vista.
                $this->vista->mostrarMensajeError("Opción no válida. Por favor, selecciona una opción válida.");
        }
    }



    function subMenuUsuarios() {
        echo "\n";
        echo "========== Menu Usuario =========\n";
        echo "1. Dar de Alta Usuario\n";
        echo "2. Dar de Baja Usuario\n";
        echo "3. Modificar Datos de Usuario\n";
        echo "4. Ver Datos e Inscripciones\n";
        echo "0. Volver al Menu Principal\n";
        echo "=========== Instiform ==========\n";
        echo "\n";
    
         $opcionUser = readline("Selecciona una opción: ");

        switch ($opcionUser){
         case '1':
            echo "Seleccionaste Dar de Alta Usuario\n";
            $nombre = readline("Ingrese nombre del Estudiante");
            $apellido = readline("Ingrese apellido del Estudiante");
            $dni = readline("Ingrese dni del Estudiante");
            $email = readline("Ingrese email del Estudiante");
            $estudiante = new Estudiante($nombre, $apellido, $dni, $email);
            $this->gestionEstudiante->agregarEstudiante($estudiante);
            break;

        case '2':
            echo "Seleccionaste Dar de Baja Usuario\n";
                echo "Ingrese el DNI del estudiante a eliminar: ";
                $dni = readline();
                $estudianteEliminado = $this->gestionEstudiante->eliminarEstudiantePorDNI($dni);
                if ($estudianteEliminado) {
                    echo "Estudiante con DNI $dni ha sido eliminado correctamente.\n";
                } else {
                    echo "No se encontró ningún estudiante con el DNI $dni.\n";
                }
            break;
        case '3':
            echo "Seleccionaste Modificar Datos de Usuario\n";
            $dniModificar = readline("Ingrese el DNI del estudiante a modificar: ");
            $estudianteEncontrado = $this->gestionEstudiante->buscarEstudiantePorDNI($dniModificar);
            if ($estudianteEncontrado) {
                $nombreNuevo = readline("Ingrese el nuevo nombre del estudiante: ");
                $apellidoNuevo = readline("Ingrese el nuevo apellido del estudiante: ");
                $emailNuevo = readline("Ingrese el nuevo email del estudiante: ");
                $this->gestionEstudiante->modificarEstudiantePorDNI($dniModificar, $nombreNuevo, $apellidoNuevo, $emailNuevo);
                echo "Los datos del estudiante con DNI $dniModificar han sido modificados correctamente.\n";
            } else {
                echo "No se encontró ningún estudiante con el DNI $dniModificar.\n";
            }
            break;
        case '4':
            $dniVer = readline("Ingrese el DNI del estudiante: ");
            $this->gestionEstudiante->verDatosEInscripcionesPorDNI($dniVer);
            break;
        case '0':
            echo "Seleccionaste Volver al Menu Principal\n";
            $this->menu($opcionUser);
        }
    }

    function subMenuCursos() {
        echo "\n";
        echo "========== Menu Cursos =========\n";
        echo "1. Dar de Alta Curso\n";
        echo "2. Dar de Baja Curso\n";
        echo "3. Modificar Datos de Curso\n";
        echo "4. Listar Cursos\n";
        echo "0. Volver al Menu Principal\n";
        echo "=========== Instiform ==========\n";
        echo "\n";

        $opcionCursos = readline("Selecciona una opción: \n");
        switch ($opcionCursos){
            case '1':
                echo "Seleccionaste Dar de Alta Cursos\n";
                $nombreCurso = readline("Ingrese el nombre del curso: ");
                $codigoCurso = readline("Ingrese el código del curso: ");

                $curso = new Curso($nombreCurso, $codigoCurso);

                $this->gestionCurso->agregarCurso($curso);

                 echo "El curso ha sido dado de alta exitosamente.\n";
            break;

             case '2':
                echo "Seleccionaste Dar de Baja Cursos\n";
                echo "1. Buscar por Nombre\n";
                echo "2. Buscar por Código\n";
                echo "0. Volver al Menú de Cursos\n";
    
                $opcionBuscar = readline("Selecciona una opción: \n");
                switch ($opcionBuscar) {
                    case '1':
                        $nombreBuscar = readline("Ingrese el nombre del curso a buscar: ");
                        $cursosEncontrados = $this->gestionCurso->buscarCursosPorNombre($nombreBuscar);
                        $this->gestionCurso->mostrarCursosEncontrados($cursosEncontrados);
            
                        if (!empty($cursosEncontrados)) {
                            $idEliminar = readline("Ingrese el ID del curso a eliminar: ");
                            $cursoEliminado = $this->gestionCurso->eliminarCursoPorID($idEliminar);
                            if ($cursoEliminado) {
                                echo "Curso con ID $idEliminar eliminado correctamente.\n";
                            } else {
                                echo "No se encontró ningún curso con el ID $idEliminar.\n";
                            }
                        }
                        break;
            
                    case '2':
                        $codigoBuscar = readline("Ingrese el código del curso a buscar: ");
                        $cursosEncontrados = $this->gestionCurso->buscarCursosPorCodigo($codigoBuscar);
                        $this->gestionCurso->mostrarCursosEncontrados($cursosEncontrados);
            
                        if (!empty($cursosEncontrados)) {
                            $idEliminar = readline("Ingrese el ID del curso a eliminar: ");
                            $cursoEliminado = $this->gestionCurso->eliminarCursoPorID($idEliminar);
                            if ($cursoEliminado) {
                                echo "Curso con ID $idEliminar eliminado correctamente.\n";
                            } else {
                                echo "No se encontró ningún curso con el ID $idEliminar.\n";
                            }
                        }
                        break;
                    case '0':
                        $this->subMenuCursos();
                        break;
                    }
                break;
            case '3':
                echo "Seleccionaste Modificar Datos de Curso\n";
                $idModificar = readline("Ingrese el ID del curso a modificar: ");
                $cursoEncontrado = $this->gestionCurso->buscarCursosPorCodigo($idModificar);
                if ($cursoEncontrado) {
                    $idNuevo = readline("Ingrese el nuevo id del curso: ");
                    $nombreNuevo = readline("Ingrese el nuevo nombre del curso: ");
                    $this->gestionCurso->modificarCursoPorId($idModificar, $idNuevo, $nombreNuevo);
                    echo "Los datos del curso id $idModificar han sido modificados correctamente.\n";
                } else {
                    echo "No se encontró ningún curso con el id $idModificar.\n";
                    }
                break;
            case '4':
                echo "Seleccionaste Listar Cursos\n";
                $cursos = $this->gestionCurso->obtenerCursos();

                if (empty($cursos)) {
                    echo "No hay cursos registrados.\n";
                } else {
                echo "Lista de Cursos:\n";
                foreach ($cursos as $curso) {
                    $this->gestionCurso->mostrarCurso($curso);;
                }
                }
                break;
            case '0':
                echo "Seleccionaste Volver Al Menu Principal\n";
                $this->menu($opcionCursos);
        }
    }

// Crear instancias del modelo y la vista
    $gestionEstudiante = new gestionEstudiante();
    $gestionCurso = new gestionCurso();
    $vista = new Vista();

// Crear instancia del controlador
    $controlador = new Controlador($gestionEstudiante, $gestionCurso, $vista);

// Ejecutar la aplicación
    $controlador->run();

}
    



/*
class MenuControlador {
    private $gestionEstudiante;
    private $gestionCurso;

    public function __construct($gestionEstudiante, $gestionCurso) {
        $this->gestionEstudiante = $gestionEstudiante;
        $this->gestionCurso = $gestionCurso;
    }

    public function run() {
        while (true) {
            $this->mainMenu();
        }
    }

    public function mainMenu() {
        // ... lógica para mostrar el menú principal y manejar la opción del usuario ...
    }

    // ... otros métodos para manejar diferentes opciones del usuario ...
}*/
