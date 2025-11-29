<?php

require "../config/Database.php";
// User class
class Usuario {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function crearUsuario($nombre, $apellido1, $apellido2, $email, $password, $avatar, $ciudad) {
        $sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, password, avatar, ciudad) VALUES (:nombre, :apellido1, :apellido2, :email, :password, :avatar, :ciudad)";
        $stmt = $this->db->prepare($sql); 
        return $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
            ':apellido1' => $apellido1,
            ':apellido2' => $apellido2,
            ':avatar' => $avatar,
            ':ciudad' => $ciudad

        ]);
    }

    public function obtenerUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

     public function obtenerUsuarioPorId($id_usuario) {
        $sql = "SELECT * FROM usuarios WHERE id = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->fetch();
    }

    public function listarUsuarios() {
        $sql = "SELECT id, nombre, email FROM usuarios";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

     public function login($nombre, $password) {

        $sql = "SELECT id, nombre, password FROM usuarios WHERE nombre = :nombre LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":nombre" => $nombre]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario["password"])) {

        
            return $usuario; // devuelve datos del usuario
            
        }
        
        return false; // credenciales inválidas
    }
}
?>
