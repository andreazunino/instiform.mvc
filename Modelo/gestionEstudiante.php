<?php
require_once('Modelo/conexionNueva.php');
class gestionEstudiante {
    private $estudiantes = [];

    public function __construct() {
        $this->cargarEstudiantesDesdePostgres();
    }

    public function agregarEstudiante($estudiante) {
        $this->estudiantes[] = $estudiante;
        $this->guardarEstudiantes();
    } 

    public function cargarEstudiantesDesdePostgres() {
        $conexion = Conexion::getConexion();
        $statement = $conexion->query("SELECT * FROM estudiante");
    
        while ($estudianteData = $statement->fetch(PDO::FETCH_ASSOC)) {
            var_dump($estudianteData); // Verifica la estructura de $estudianteData
            $estudiante = $this->arrayToEstudiante($estudianteData);
            $this->estudiantes[] = $estudiante;
        }
    }

    private function arrayToEstudiante($estudianteData) {
        return new Estudiante(
            $estudianteData->nombre,
            $estudianteData->apellido,
            $estudianteData->dni,
            $estudianteData->email
        );
    }
    
    



    public function eliminarEstudiantePorDNI($dni) {
        $indice = -1;
        foreach ($this->estudiantes as $key => $estudiante) {
            if ($estudiante->getDNI() === $dni) {
                $indice = $key;
                break;
            }
        }

        if ($indice !== -1) {
            array_splice($this->estudiantes, $indice, 1);
            $this->guardarEstudiantes();
            return true;
        }

        return false;
    }
    
    public function modificarEstudiantePorDNI($dni, $nuevoNombre, $nuevoApellido, $nuevoEmail) {
        foreach ($this->estudiantes as $estudiante) {
            if ($estudiante->getDNI() === $dni) {
                $estudiante->setNombre($nuevoNombre);
                $estudiante->setApellido($nuevoApellido);
                $estudiante->setEmail($nuevoEmail);
                $this->guardarEnJSON();
                return true;
            }
        }

        return false;
    }

    public function buscarEstudiantePorDNI($dni) {
        foreach ($this->estudiantes as $estudiante) {
            if ($estudiante->getDNI() === $dni) {
                return $estudiante;
            }
        }

        return null;
    }

    public function verDatosEInscripcionesPorDNI($dni) {
        $estudianteEncontrado = null;

        foreach ($this->estudiantes as $estudiante) {
            if ($estudiante->getDNI() === $dni) {
                $estudianteEncontrado = $estudiante;
                break;
            }
        }

        if ($estudianteEncontrado !== null) {
            echo "Datos del estudiante:\n";
            echo "Nombre: " . $estudianteEncontrado->getNombre() . "\n";
            echo "Apellido: " . $estudianteEncontrado->getApellido() . "\n";
            echo "DNI: " . $estudianteEncontrado->getDNI() . "\n";
            echo "Email: " . $estudianteEncontrado->getEmail() . "\n";
        } else {
            echo "No se encontró ningún estudiante con el DNI $dni.\n";
        }
    }

    public function guardarEstudiantes() {
        $conexion = Conexion::getConexion();

        // Borra todos los registros existentes en la tabla para evitar duplicados al guardar
        $conexion->query("DELETE FROM estudiante");

        $query = $conexion->prepare("INSERT INTO estudiante (nombre, apellido, dni, email) VALUES (:nombre, :apellido, :dni, :email)");


        foreach ($this->estudiantes as $estudiante) {
            $nombre = $estudiante->getNombre();
            $apellido = $estudiante->getApellido();
            $dni = $estudiante->getDNI();
            $email = $estudiante->getEmail();

            $query->bindParam(':nombre', $nombre);
            $query->bindParam(':apellido', $apellido);
            $query->bindParam(':dni', $dni);
            $query->bindParam(':email', $email);
            $query->execute();
}

}
}