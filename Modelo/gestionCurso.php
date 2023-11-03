<?php
class gestionCurso {
    private $cursos = [];

    public function __construct() {
        $this->cargarCursosDesdePostgres();
    }

    public function agregarCurso($curso) {
        foreach ($this->cursos as $cursoExistente) {
            if ($cursoExistente->getId() === $curso->getId()) {
                echo "El curso con ID {$curso->getId()} ya existe en la lista de cursos.\n";
                return;
            }
        }  
        echo "El curso se agrego exitosamente\n";
        $this->cursos[] = $curso;
        $this->guardarCursos();
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
                $this->guardarCursos();
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
                $this->guardarCursos();
                return true;
            }
        }
    }

    public function obtenerCursos() {
        return $this->cursos;
    }

    public function cargarCursosDesdePostgres() {
        $conexion = Conexion::getConexion();
        $query = $conexion->query("SELECT * FROM curso");
        $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $cursoData) {
            $curso = new Curso($cursoData['id'], $cursoData['nombre']);
            $this->cursos[] = $curso;
        }
    }

    private function guardarCursos() {
        $conexion = Conexion::getConexion();
        $conexion->query("DELETE FROM curso");

        $query = $conexion->prepare("INSERT INTO curso (id, nombre) VALUES (:id, :nombre)");

        foreach ($this->cursos as $curso) {
            $id = $curso->getId();
            $nombre = $curso->getNombre();

            $query->bindParam(':id', $id);
            $query->bindParam(':nombre', $nombre);
            $query->execute();
        }
    }
}
