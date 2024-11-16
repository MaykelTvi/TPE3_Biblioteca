<?php
require_once 'config.php';
class modelLibros{
    private $db;

    public function __construct(){
        $this->db = new PDO ('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8',MYSQL_USER, MYSQL_PASS);
    }

    function getLibros($sort = 'titulo', $order = 'ASC') {
        $campos_validos = ['titulo', 'autor', 'prestado'];  
        $order = $order === 'DESC' ? 'DESC' : 'ASC';  
    
        if (!in_array($sort, $campos_validos)) {
            $sort = 'titulo';
        }
    
        $query = $this->db->prepare("SELECT * FROM libros ORDER BY $sort $order");
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getLibro($id) {
        $query = $this->db->prepare('SELECT * FROM libros WHERE id_libro = ?');
        $query->execute([$id]);
        $libros = $query->fetchAll(PDO::FETCH_OBJ);
        return $libros;
    }

    public function addLibro($titulo, $autor, $prestado){
        $query = $this->db->prepare('INSERT INTO libros(titulo, autor, prestado) VALUES (?,?,?)');
        $query->execute([$titulo, $autor, $prestado]);
    }
    public function deleteLibro($libro){
        $query = $this->db->prepare ('DELETE FROM libros WHERE id_libro = ?');
        $query->execute([$libro]);
        $libro = $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function editLibro($titulo, $autor, $prestado, $id){
        $query = $this->db->prepare('UPDATE libros SET titulo = ?, autor = ?, prestado = ? WHERE id_libro = ?');
        $query->execute([$titulo, $autor, $prestado, $id]);
    }
}