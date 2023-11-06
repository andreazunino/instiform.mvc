<?php
    require_once('Modelo/gestionEstudiante.php');
    require_once('Modelo/gestionCurso.php');    
    class Inscripcion {
    private $inscripciones = [];
    
    

    public function cargarInscripciones($estudiantes, $cursos) {
        $estudianteElegido = readline("Ingrese el DNI del estudiante: ");

        echo "Cursos Disponibles:\n";
        foreach ($cursos as $curso) {
            echo "ID del Curso: {$curso->getId()}, - Nombre del Curso: {$curso->getNombre()}\n";
        }

        $cursoElegido = readline("Ingrese el ID del curso: ");

        $inscripcion = [
            "id" => count($this->inscripciones) + 1,
            "id_curso" => $cursoElegido,
            "dni_estudiante" => $estudianteElegido
        ];

        $this->inscripciones[] = $inscripcion;
        echo "Inscripcion exitosa\n";
    }
}

?>