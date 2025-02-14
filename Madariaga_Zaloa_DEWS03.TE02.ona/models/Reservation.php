<?php
class Reservation {
    private $data;
    private const DATA_PATH = "../data";


    public function __construct() {
        $this->data = json_decode(file_get_contents(self::DATA_PATH . '/reservas.json'), true);
    }

    public function createReservation($reservation) {
        $this->data[] = $reservation;
        file_put_contents(self::DATA_PATH . '/reservas.json', json_encode($this->data));
    }

    public function getAllReservations() {
        return $this->data;
    }

    
    public function modify($id, $checkIn, $checkOut) {
        // Array para almacenar los nuevos datos modificados
        $newData = [];
    
        // Iterar sobre las reservas para modificar la correcta
        foreach ($this->data as $reservation) {
            if ($reservation['id'] === $id) {
                // Modificar las fechas de la reserva
                $reservation['fecha_entrada'] = $checkIn;
                $reservation['fecha_salida'] = $checkOut;
            }
            // Agregar la reserva al nuevo array
            $newData[] = $reservation;
        }
    
        // Verificar si se modificaron los datos
        if ($this->data !== $newData) {
            // Guardar los cambios en el archivo JSON
            file_put_contents(self::DATA_PATH . '/reservas.json', json_encode($newData, JSON_PRETTY_PRINT));
            return true;
        }
    
        return false; // No se modificó nada
    }
    public function deleteReservation($id) {
        // Crear un nuevo array para almacenar las reservas restantes
        $newData = [];
    
        // Iterar a través de las reservas para encontrar y eliminar la reserva
        $found = false;
        foreach ($this->data as $reservation) {
            if ($reservation['id'] === $id) {
                // Si la reserva coincide con el ID, la eliminamos
                $found = true;
                continue;  // Skip this reservation (no add to new data)
            }
            // Agregar las demás reservas al nuevo array
            $newData[] = $reservation;
        }
    
        // Si encontramos y eliminamos la reserva, guardamos los cambios
        if ($found) {
            file_put_contents(self::DATA_PATH . '/reservas.json', json_encode($newData, JSON_PRETTY_PRINT));
            return true;
        }
    
        // Si no encontramos la reserva, devolvemos falso
        return false;
    }
    
}
?>
