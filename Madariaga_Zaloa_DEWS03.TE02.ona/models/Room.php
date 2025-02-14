<?php
class Room {
    private $data;
    private const DATA_PATH = "../data";


    public function __construct() {
        $this->data = json_decode(file_get_contents(self::DATA_PATH . '/habitaciones.json'), true);
    }

    public function getAllRooms() {
        return $this->data;
    }
}
?>