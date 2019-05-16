<?php 

Class Kendaraan {

    public function selectAll() {
        $query = "SELECT a.*, b.nama FROM kendaraan a LEFT JOIN jenis b ON a.id_jenis = b.id_jenis";
        return $query;
    }

    public function selectAllStatus() {
        $query = "SELECT * FROM jenis";
        return $query;
    }

    public function selectById($id) {
        $query = "SELECT a.*, b.nama FROM kendaraan a LEFT JOIN jenis b ON a.id_jenis = b.id_jenis WHERE id_kendaraan='$id'";
        return $query;
    }

    public function insert($nama, $idjenis, $maxmuatan) {
        $query = "INSERT INTO kendaraan (nama_kendaraan, id_jenis, max_muatan) VALUES ('$nama','$idjenis','$maxmuatan')";
        return $query;
    }

    public function update($id, $nama, $idjenis, $maxmuatan) {
        $query = "UPDATE kendaraan SET nama_kendaraan='$nama', id_jenis='$idjenis', max_muatan='$maxmuatan' WHERE id_kendaraan='$id'";
        return $query;
    }

    public function delete($id) {
        $query = "DELETE FROM kendaraan WHERE id_kendaraan='$id'";
        return $query;
    }

}

?>