<?php
class User {
    private $data;
    private const DATA_PATH = "../data";

    public function __construct() {
        $this->data = json_decode(file_get_contents( self::DATA_PATH . '/usuarios.json'), true);
    }

    public function register($username, $password) {
        
        
        $newUser  = ['username' => $username, 'password' => $password, 'role' => 'USER'];
        $this->data[] = $newUser ;
        file_put_contents(self::DATA_PATH . '/usuarios.json', json_encode($this->data, JSON_PRETTY_PRINT));
    }

    public function login($username, $password) {
        foreach ($this->data as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                return $user;
            }
        }
        return null;
    }
    public function checkAdmin($password) {
        foreach ($this->data as $user) {
            if ($user['role'] === "ADMIN" && $user['password'] === $password) {
                return $user;
            }
        }
        return null;
    }

    public function userExists($username) {
        foreach ($this->data as $user) {
            if ($user['username'] === $username) {
                return true;  // El usuario ya existe
            }
        }
        return false;  // El usuario no existe
    }
}
?>