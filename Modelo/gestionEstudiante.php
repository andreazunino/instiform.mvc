<?php
class gestionEstudiante {
    private $estudiantes = [];

    public function __construct() {
        $this->cargarDesdeJSON();
    }

    public function agregarEstudiante($estudiante) {
        $this->estudiantes[] = $estudiante;
        $this->guardarEnJSON();
    } 

    private function cargarDesdeJSON() {
        if (file_exists('data.json')) {
            $jsonData = file_get_contents('data.json');
            $data = json_decode($jsonData, true);

            if ($data && isset($data['estudiantes'])) {
                foreach ($data['estudiantes'] as $estudianteData) {
                    $this->estudiantes[] = $this->arrayToEstudiante($estudianteData);
                }
            }
        }
    }

    private function arrayToEstudiante($estudianteData) {
        return new Estudiante(
            $estudianteData['nombre'],
            $estudianteData['apellido'],
            $estudianteData['dni'],
            $estudianteData['email']
        );
    }

    private function guardarEnJSON() {
        $data = [
            'estudiantes' => array_map([$this, 'estudianteToArray'], $this->estudiantes),
        ];

        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('data.json', $jsonData);
    }

    private function estudianteToArray($estudiante) {
        return [
            'nombre' => $estudiante->getNombre(),
            'apellido' => $estudiante->getApellido(),
            'dni' => $estudiante->getDNI(),
            'email' => $estudiante->getEmail(),
        ];
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
            $this->guardarEnJSON();
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
}
