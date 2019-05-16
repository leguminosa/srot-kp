<?php

Class Supir {

    public function selectAll() {
        $query = "SELECT * FROM supir s LEFT JOIN status st ON s.id_status = st.id";
        return $query;
    }

    public function selectAllStatus() {
        $query = "SELECT * FROM status";
        return $query;
    }

    public function selectById($id) {
        $query = "SELECT * FROM supir s LEFT JOIN status st ON s.id_status = st.id WHERE id_supir='$id'";
        return $query;
    }

    public function insert($nama, $status) {
        $query = "INSERT INTO supir (nama_supir, id_status) VALUES ('$nama','$status')";
        return $query;
    }

    public function update($id, $nama, $status) {
        $query = "UPDATE supir SET nama_supir='$nama', id_status='$status' WHERE id_supir='$id'";
        return $query;
    }

    public function delete($id) {
        $query = "DELETE FROM supir WHERE id_supir='$id'";
        return $query;
    }

}

?>