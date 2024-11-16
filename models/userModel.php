<?php
require_once 'config.php';
class UserModel{
    private $db;

    public function __construct(){
        $this->db = new PDO ('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8',MYSQL_USER, MYSQL_PASS);
    }

    public function getUsuarioByUser($user){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$user]);
        $usuario = $query->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }
}
?>