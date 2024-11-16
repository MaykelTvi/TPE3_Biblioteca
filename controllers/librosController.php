<?php
require_once 'controllers/apiController.php';
require_once 'models/librosModel.php';
require_once 'views/apiView.php';
class librosController extends apiController{
    public function __construct(){
        parent::__construct();
        $this->model = new modelLibros();
        $this->view = new apiView();
    }

    public function listarLibros($params = []) {
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'titulo'; 
        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';  
    
        $libros = $this->model->getLibros($sort, $order);
    
        if ($libros) {
            echo json_encode($libros, JSON_PRETTY_PRINT, 200);
        } else {
            $this->view->response('Error al obtener libros', 500);
        }
    }
    public function modificarLibro($params = []) {
        $id = $params[':ID'];

        $libroID = $this->model->getLibro($id);

        if($libroID) {
            $data = $this->getData();

            $titulo = $data->titulo;
            $autor = $data->autor;
            $prestado = $data->prestado;

            if (!empty($titulo) && !empty($autor) && !empty($prestado)){
                $this->model->editLibro($titulo, $autor, $prestado, $id);
                $this->view->response('Se ha modificado con éxito', 200);
            } else {
                $this->view->response('Complete los campos', 400);
            }
        } else {
            $this->view->response('No existe libro con ese id', 404);
        }
    }
    public function listarLibroPorId($params = []) { 
  
        $id = $params[':ID'];  
    
        $libro = $this->model->getLibro($id);
    
        if ($libro) {
            $this->view->response(json_encode($libro, JSON_PRETTY_PRINT), 200);
        } else {
            $this->view->response('No existe libro con ese id', 404);
        }
    }
    public function agregarLibro($params = []) {
        $data = $this->getData();
        
        $titulo = $data->titulo;
        $autor = $data->autor;
        $prestado = $data->prestado;

        if ($titulo && $autor && $prestado !== null){
            $this->model->addLibro($titulo, $autor, $prestado);
            $this->view->response('Se ha agregado el libro con exito', 201);
        } else {
            $this->view->response('Error al agregar', 400);
        }
    }
    public function eliminarLibro($params = []){
        $id = $params[':ID'];

        $libroID = $this->model->getLibro($id);

        if($libroID){
            $exito = $this->model->deleteLibro($id);
            $this->view->response('Se pudo eliminar el libro con el id ' . $id, 200);
        } else {
            $this->view->response('No se pudo eliminar ya que no existe el libro con el id' . $id, 404);
        }
    }
}