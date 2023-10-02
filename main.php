<?php

require_once('Modelo/estudiante.php');
require_once('Modelo/curso.php');
require_once('Modelo/gestionEstudiante.php');
require_once('Modelo/gestionCurso.php');
require_once('Vista/menuVista.php');
require_once('Controlador/menuControlador.php');

// Crear instancias del modelo
$gestionEstudiante = new GestionEstudiante();
$gestionCurso = new GestionCurso();

// Crear instancia de la vista
$vista = new Vista();

// Crear instancia del controlador
$menu = new Controlador($gestionEstudiante, $gestionCurso, $vista);

// Ejecutar la aplicación
//Controlador::run()
$menu->run();

