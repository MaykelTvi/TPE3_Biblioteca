<?php
require_once 'libs/Router.php';
require_once 'controllers/prestamosController.php';
require_once 'controllers/librosController.php';

$router = new Router();

$router->addRoute('prestamos', 'GET', 'prestamosController', 'listarPrestamos');
$router->addRoute('prestamo/:ID', 'PUT', 'prestamosController', 'modificarPrestamo');
$router->addRoute('prestamo', 'POST', 'prestamosController', 'agregarPrestamo');
$router->addRoute('prestamo/:ID', 'DELETE', 'prestamosController', 'eliminarPrestamo');

$router->addRoute('libros', 'GET', 'librosController', 'listarLibros');
$router->addRoute('libros/:ID', 'GET', 'librosController', 'listarLibroPorId');
$router->addRoute('libro/:ID', 'PUT', 'librosController', 'modificarLibro');
$router->addRoute('libro', 'POST', 'librosController', 'agregarLibro');
$router->addRoute('libro/:ID', 'DELETE', 'librosController', 'eliminarLibro');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);