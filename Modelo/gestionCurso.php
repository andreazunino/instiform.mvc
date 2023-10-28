<?php
class gestionCurso {
    private $cursos = [];
    public function agregarCurso($curso) {
        $this->cursos[] = $curso;
    }
    public function buscarCursosPorNombre($nombre) {
        $cursosEncontrados = [];
        foreach ($this->cursos as $curso) {
            if (strtolower($curso->getNombre()) === strtolower($nombre)) {
                $cursosEncontrados[] = $curso;
            }
        }
        return $cursosEncontrados;
    }

    public function buscarCursosPorCodigo($id) {
        $cursosEncontrados = [];
        foreach ($this->cursos as $curso) {
            if ($curso->getId() === $id) {
                $cursosEncontrados[] = $curso;
            }
        }
        return $cursosEncontrados;
    }
    public function mostrarCursosEncontrados($cursos) {
        if (empty($cursos)) {
            echo "No se encontraron cursos.\n";
        } else {
            echo "Cursos encontrados:\n";
            foreach ($cursos as $curso) {
                $this->mostrarCurso($curso);
            }
        }
    }

    public function mostrarCurso($curso) {
        echo "ID: " . $curso->getId() . "\n";
        echo "Nombre: " . $curso->getNombre() . "\n";
        echo "===============================\n";
    }
    
    public function eliminarCursoPorID($id) {
        foreach ($this->cursos as $key => $curso) {
            if ($curso->getId() === $id) {
                unset($this->cursos[$key]);
                return true;
            }
        }
        return false;
    }
    public function modificarCursoPorId($id, $nuevoId, $nuevoNombre) {
        foreach ($this->cursos as $curso) {
            if ($curso->getId() === $id) {
                $curso->setId($nuevoId);
                $curso->setNombre($nuevoNombre);
                return true;
            }
        }
    }
    public function obtenerCursos() {
        return $this->cursos;
    }
}
