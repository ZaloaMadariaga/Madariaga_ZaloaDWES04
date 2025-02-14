<?php
require_once '../models/Room.php';

class RoomController {
    public function getAllRooms() {
        $room = new Room();
        $rooms = $room->getAllRooms();
        http_response_code(200);
        echo json_encode($rooms);
    }
}
?>