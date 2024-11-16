<?php
require_once 'config.php';
class prestamosModel {
    private $db;

    public function __construct() {
        $this->db = new PDO ('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8',MYSQL_USER, MYSQL_PASS);
    }

    public function getPrestamos(){
        $query = $this->db->prepare('SELECT * FROM prestamos');
        $query->execute();
        $prestamos = $query->fetchAll(PDO::FETCH_OBJ);
        return $prestamos;

    }

    function getPrestamosLibro($libro){
        $query = $this->db->prepare('SELECT * FROM prestamos WHERE id_libro = ?');
        $query->execute([$libro]);
        $prestamos = $query->fetchAll(PDO::FETCH_OBJ);
        return $prestamos;
    }
    public function getPrestamo($id){
        $query = $this->db->prepare('SELECT * FROM prestamos WHERE id_prestamo = ?');
        $query->execute([$id]);
        $producto = $query->fetch(PDO::FETCH_OBJ);
        return $producto;
    }
    public function addPrestamo($idLibro, $idUsuario, $fecha){
        $query = $this->db->prepare('INSERT INTO prestamos (id_libro, id_usuario, fecha_prestamo VALUES (?,?,?)');
        $query->execute([$idLibro, $idUsuario, $fecha]);
    }
    public function deletePrestamo($prestamo){
        $query = $this->db->prepare('DELETE FROM prestamos WHERE id_prestamo = ?');
        $query->execute([$prestamo]);
    }

    public function editPrestamo($idLibro, $idUsuario, $fecha){
        $query = $this->db->prepare('UPDATE prestamos SET id_libro = ?, id_usuario = ?, fecha_prestamo = ? WHERE id_prestamo = ?');
        $query->execute([$idLibro, $idUsuario, $fecha]);
    }
}

?>