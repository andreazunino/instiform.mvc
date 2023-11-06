<?php
require_once('Modelo/gestionCurso.php');
require_once('Modelo/gestionEstudiante.php');

class Inscripcion {
    private $inscripciones = [];

    public function __construct() {
        $this->cargarInscripcionesDesdePostgres();
    }
    public function cargarInscripciones() {
        $gestionEstudiante = new gestionEstudiante();
        $estudiantes = $gestionEstudiante->obtenerEstudiantesParaInscripcion();

        $gestionCurso = new gestionCurso();
        $cursos = $gestionCurso->obtenerCursosParaInscripcion();

        echo "Estudiantes Disponibles:\n";
        foreach ($estudiantes as $estudiante) {
            echo "DNI del Estudiante: {$estudiante->getDNI()}, - Nombre del Estudiante: {$estudiante->getNombre()}\n";
        }

        $estudianteElegido = readline("Ingrese el DNI del estudiante: ");
        echo "Cursos Disponibles:\n";
        foreach ($cursos as $curso) {
            echo "ID del Curso: {$curso->getId()}, - Nombre del Curso: {$curso->getNombre()}\n";
        }

        $cursoElegido = readline("Ingrese el ID del curso: ");

        // Comprueba si el estudiante y el curso existen en los arreglos
        $estudianteExiste = false;
        $cursoExiste = false;

        foreach ($estudiantes as $estudiante) {
            if ((int)$estudiante->getDNI() === (int)$estudianteElegido) {
                $estudianteExiste = true;
                break;
            }
        }

        foreach ($cursos as $curso) {
            if ((int)$curso->getId() === (int)$cursoElegido) {
                $cursoExiste = true;
                break;
            }
        }

        if (!$estudianteExiste) {
            echo "El estudiante con DNI {$estudianteElegido} no se encontró.\n";
            return;
        }

        if (!$cursoExiste) {
            echo "El curso con ID {$cursoElegido} no se encontró.\n";
            return;
        }

        $inscripcion = [
            "id" => count($this->inscripciones) + 1,
            "id_curso" => $cursoElegido,
            "dni_estudiante" => $estudianteElegido
        ];

        $this->inscripciones[] = $inscripcion;
        echo "Inscripcion exitosa\n";
        $this->guardarInscripciones();
    }
    
    
    public function cargarInscripcionesDesdePostgres() {
        $conexion = Conexion::getConexion();
        $query = $conexion->query("SELECT * FROM inscripcion");
        $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $inscripcionData) {
            $inscripcion = [
                "id" => $inscripcionData['id'],
                "id_curso" => $inscripcionData['id_curso'],
                "dni_estudiante" => $inscripcionData['dni_estudiante']
            ];
            $this->inscripciones[] = $inscripcion;
        }
    }

    public function guardarInscripciones() {
        $inscripciones = $this->inscripciones;
        $conexion = Conexion::getConexion();
        foreach ($inscripciones as $inscripcion) {
            $id = $inscripcion['id'];
            $idCurso = $inscripcion['id_curso'];
            $dniEstudiante = $inscripcion['dni_estudiante'];
            $sql = "INSERT INTO inscripcion (id, id_curso, dni_estudiante) VALUES ('$id', '$idCurso', '$dniEstudiante') ON CONFLICT (id) DO NOTHING";
            Conexion::ejecutar($sql);
        }
    }
    public function listarInscripciones() {
        if (empty($this->inscripciones)) {
            echo "No hay inscripciones disponibles.\n";
        } else {
            echo "Lista de inscripciones:\n";
            foreach ($this->inscripciones as $inscripcion) {
                echo "ID de inscripción: " . $inscripcion['id'] . ", ID del Curso: " . $inscripcion['id_curso'] . ", DNI del Estudiante: " . $inscripcion['dni_estudiante'] . "\n";
            }
        }
    }

    public function eliminarInscripcionPorID($idInscripcion) {
        $conexion = Conexion::getConexion();
        try {
            $sql = "DELETE FROM inscripcion WHERE id = '$idInscripcion'";
            Conexion::ejecutar($sql);
    
            $indice = null;
            foreach ($this->inscripciones as $key => $inscripcion) {
                if ((int)$inscripcion['id'] === (int)$idInscripcion) {
                    $indice = $key;
                    break;
                }
            }
            if ($indice !== null) {
                unset($this->inscripciones[$indice]);
                $this->guardarInscripciones();
                echo "Inscripción eliminada exitosamente.\n";
            } else {
                echo "No se encontró ninguna inscripción con el ID especificado.\n";
            }
        } catch (PDOException $e) {
            echo 'Error al eliminar inscripción: ' . $e->getMessage();
        }
    }

    public function mostrarInscripcionesPorDNI($dni) {
        $inscripcionesEncontradas = [];
    
        $gestionCurso = new gestionCurso();
        $cursos = $gestionCurso->obtenerCursos(); // Obtener la lista completa de cursos
    
        foreach ($this->inscripciones as $inscripcion) {
            if ((int)$inscripcion['dni_estudiante'] === (int)$dni) {
                $idInscripcion = $inscripcion['id'];
                $idCurso = $inscripcion['id_curso'];
    
                // Buscar el nombre del curso correspondiente
                $nombreCurso = "Curso no encontrado"; // Valor predeterminado si no se encuentra el curso
                foreach ($cursos as $curso) {
                    if ((int)$curso->getId() === (int)$idCurso) {
                        $nombreCurso = $curso->getNombre();
                        break;
                    }
                }
    
                $inscripcionesEncontradas[] = "ID de inscripción: {$idInscripcion}, Asociado al ID de curso: {$idCurso} - Nombre del Curso: {$nombreCurso}";
            }
        }
    
        if (empty($inscripcionesEncontradas)) {
            echo "No se encontraron inscripciones asociadas al DNI proporcionado.\n";
        } else {
            echo "Inscripciones encontradas para el DNI {$dni}:\n";
            foreach ($inscripcionesEncontradas as $inscripcionEncontrada) {
                echo $inscripcionEncontrada . "\n";
            }
        }
    }
}

