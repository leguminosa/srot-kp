<?php 

Class Katalog {

    public function selectAll() {
        $query =
        "SELECT a.*, b.nama_kendaraan, c.nama_supir
        FROM truck a LEFT JOIN kendaraan b ON a.id_kendaraan = b.id_kendaraan LEFT JOIN supir c ON a.id_supir = c.id_supir
        WHERE c.id_status = '1' AND a.id NOT IN ( SELECT DISTINCT id_truck FROM detail_booking WHERE status = '0' )";
        return $query;
    }

    public function selectAllStatus() {
        $query = "SELECT * FROM kendaraan";
        return $query;
    }

    public function selectAllSupir() {
        $query = "SELECT * FROM supir";
        return $query;
    }

    public function selectById($id) {
        $query = "SELECT a.*, b.nama_kendaraan, c.nama_supir FROM truck a LEFT JOIN kendaraan b ON a.id_kendaraan = b.id_kendaraan LEFT JOIN supir c ON a.id_supir = c.id_supir WHERE id='$id'";
        return $query;
    }

    public function insert($user, $truck) {
        $query = "INSERT INTO detail_booking (id_user, id_truck) VALUES ('$user','$truck')";
        return $query;
    }

    public function update($id, $id_kendaraan, $id_supir, $plat, $gmbr) {
        $query = "UPDATE truck SET id_kendaraan='$id_kendaraan', id_supir='$id_supir', no_polisi='$plat', gambar='$gmbr' WHERE id='$id'";
        return $query;
    }

    public function delete($id) {
        $query = "DELETE FROM truck WHERE id='$id'";
        return $query;
    }

}

?>