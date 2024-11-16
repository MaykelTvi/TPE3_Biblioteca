<?php
require_once 'controllers/apiController.php';
require_once 'models/prestamosModel.php';
require_once 'views/apiView.php';
class prestamosController extends apiController{
    public function __construct(){
        parent::__construct();
        $this->model = new prestamosModel();
        $this->view = new apiView();
    }

    public function listarPrestamos($params = []) {
        $prestamos = $this->model->getPrestamos();
        if($prestamos) {
            echo json_encode($prestamos, JSON_PRETTY_PRINT, 200);
        } else {
            $this->view->response('Error', 500);
        }

    }
    public function modificarPrestamo($params = []) {
        $id = $params[':ID'];

        $prestamoID = $this->model->getPrestamo($id);

        if($prestamoID) {
            $data = $this->getData();

            $id_libro = $data->id_libro;
            $id_usuario = $data->id_usuario;
            $fecha = $data->fecha_prestamo;

            if (!empty($id_libro) && !empty($id_usuario) && !empty($fecha)){
                $this->model->editPrestamo($id_libro, $id_usuario, $fecha, $id);
                $this->view->response('Se ha modificado con éxito', 204);
            } else {
                $this->view->response('Complete los campos', 400);
            }
        } else {
            $this->view->response('No existe prestamo con ese id', 404);
        }
    }
    public function agregarPrestamo($params = []) {
        $data = $this->getData();

        $id_libro = $data->id_libro;
        $id_usuario = $data->id_usuario;
        $fecha = $data->fecha_prestamo;

        if ($id_libro && $id_usuario && $fecha){
            $this->model->addPrestamo($id_libro, $id_usuario, $fecha);
            $this->view->response('Se ha agregado el prestamo con éxito', 201);
        } else {
            $this->view->response('Error al agregar', 400);
        }
    }
    public function eliminarPrestamo($params = []){
        $id = $params[':ID'];

        $prestamoID = $this->model->getPrestamo($id);

        if($prestamoID){
            $exito = $this->model->deletePrestamo($id);
            if($exito){
                $this->view->response('Se pudo eliminar el prestamo con el id ' . $id, 200);
            } else {
                $this->view->response('No se pudo eliminar el prestamo', 500);
            }
        } else {
            $this->view->response('No se pudo eliminar ya que no existe prestamo con ese id' . $id, 404);
        }
    }
}