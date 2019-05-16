<?php 

Class Jenis {

    public function selectAll() {
        $query = "SELECT * FROM jenis";
        return $query;
    }

    public function selectById($id) {
        $query = "SELECT * FROM jenis WHERE id_jenis='$id'";
        return $query;
    }

    public function insert($nama, $banyakroda, $ket) {
        $query = "INSERT INTO jenis (nama, banyak_roda, keterangan) VALUES ('$nama','$banyakroda','$ket')";
        return $query;
    }

    public function update($id, $nama, $banyakroda, $ket) {
        $query = "UPDATE jenis SET nama='$nama', banyak_roda='$banyakroda', keterangan='$ket' WHERE id_jenis='$id'";
        return $query;
    }

    public function delete($id) {
        $query = "DELETE FROM jenis WHERE id_jenis='$id'";
        return $query;
    }

}

?>