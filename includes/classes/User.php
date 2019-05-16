<?php

Class User {

    public function selectAll() {
        $query = "SELECT * FROM user";
        return $query;
    }

    public function insert($nama, $email, $pass, $ket) {
        $query = "INSERT INTO user VALUES ('$nama','$email','$password','$ket')";
        return $query;
    }

    public function update($id, $nama, $email, $pass, $ket) {
        $query = "UPDATE user SET nama_user='$nama', email_user='$email', password='$pass', keterangan='$ket' WHERE id_user='$id'";
        return $query;
    }

    public function delete($id) {
        $query = "DELETE FROM user WHERE id_user='$id'";
        return $query;
    }

}

?>