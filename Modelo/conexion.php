<?php
$host = 'tu_host'; // La dirección del servidor de la base de datos
$dbname = 'tu_base_de_datos'; // Nombre de la base de datos
$username = 'tu_usuario'; // Nombre de usuario de la base de datos
$password = 'tu_contraseña'; // Contraseña del usuario

try {
    // Establecer la conexión con la base de datos usando PDO
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    
    // Configurar el modo de error de PDO para que lance excepciones en caso de errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Realizar operaciones en la base de datos aquí...

} catch (PDOException $e) {
    // Capturar y manejar errores de la conexión
    echo "Error de conexión: " . $e->getMessage();
}
?>

$pdo = new PDO('mysql:host=localhost;dbname=tu_base_de_datos', 'usuario', 'contraseña');


class DBManager {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'tu_base_de_datos';
        $username = 'usuario';
        $password = 'contraseña';

        $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }

    public function insertarEstudiante($estudiante) {
        $stmt = $this->pdo->prepare("INSERT INTO estudiantes (nombre, apellido, dni, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$estudiante->nombre, $estudiante->apellido, $estudiante->dni, $estudiante->email]);
    }

    public function obtenerEstudiantePorDNI($dni) {
        $stmt = $this->pdo->prepare("SELECT * FROM estudiantes WHERE dni = ?");
        $stmt->execute([$dni]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Métodos similares para cursos...
}
