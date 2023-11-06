<?php

require_once('Modelo/estudiante.php');
require_once('Modelo/curso.php');
require_once('Modelo/gestionEstudiante.php');
require_once('Modelo/gestionCurso.php');
require_once('Vista/menuVista.php');
require_once('Controlador/menuControlador.php');
require_once('Modelo/conexionNueva.php');

$db = Conexion::getConexion();
if ($db != null) {
    echo "Conexion Establecida";
    echo PHP_EOL;
}


// Crear instancias del modelo
$gestionEstudiante = new GestionEstudiante();
$gestionCurso = new GestionCurso();
$inscripcion = new Inscripcion();


// Crear instancia de la vista
$vista = new Vista();

// Crear instancia del controlador
$menu = new Controlador($gestionEstudiante, $gestionCurso, $vista, $inscripcion);

// Ejecutar la aplicación
//Controlador::run()
 $menu->run();

