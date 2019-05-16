<?php 

Class Truck {

    public function selectAll() {
        $query = "SELECT a.*, b.nama_kendaraan, c.nama_supir FROM truck a LEFT JOIN kendaraan b ON a.id_kendaraan = b.id_kendaraan LEFT JOIN supir c ON a.id_supir = c.id_supir";
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

    public function insert($id_kendaraan, $id_supir, $plat, $gmbr) {
        $query = "INSERT INTO truck (id_kendaraan, id_supir, no_polisi, gambar) VALUES ('$id_kendaraan','$id_supir','$plat', '$gmbr')";
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