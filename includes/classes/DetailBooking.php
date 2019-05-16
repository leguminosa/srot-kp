<?php 

    Class DetailBooking {

    public function selectAll() {
        $query =
        "SELECT a.*, f.nama_user, CASE WHEN a.status = 0 THEN 'Ongoing' ELSE 'Completed' END AS statusname,
        c.nama_kendaraan, e.nama, b.no_polisi, d.nama_supir, b.gambar
        FROM detail_booking a
        LEFT JOIN truck b ON a.id_truck = b.id
        LEFT JOIN kendaraan c ON b.id_kendaraan = c.id_kendaraan
        LEFT JOIN supir d ON b.id_supir = d.id_supir
        LEFT JOIN jenis e ON c.id_jenis = e.id_jenis
        LEFT JOIN user f ON a.id_user = f.id_user";
        return $query;
    }

    public function selectAllOngoing() {
        $query =
        "SELECT a.*, f.nama_user, CASE WHEN a.status = 0 THEN 'Ongoing' ELSE 'Completed' END AS statusname,
        c.nama_kendaraan, e.nama, b.no_polisi, d.nama_supir, b.gambar
        FROM detail_booking a
        LEFT JOIN truck b ON a.id_truck = b.id
        LEFT JOIN kendaraan c ON b.id_kendaraan = c.id_kendaraan
        LEFT JOIN supir d ON b.id_supir = d.id_supir
        LEFT JOIN jenis e ON c.id_jenis = e.id_jenis
        LEFT JOIN user f ON a.id_user = f.id_user
        WHERE a.status='0'";
        return $query;
    }

    public function selectAllByUserID($userID) {
        $query =
        "SELECT a.*, CASE WHEN a.status = 0 THEN 'Ongoing' ELSE 'Completed' END AS statusname,
        c.nama_kendaraan, e.nama, b.no_polisi, d.nama_supir, b.gambar
        FROM detail_booking a
        LEFT JOIN truck b ON a.id_truck = b.id
        LEFT JOIN kendaraan c ON b.id_kendaraan = c.id_kendaraan
        LEFT JOIN supir d ON b.id_supir = d.id_supir
        LEFT JOIN jenis e ON c.id_jenis = e.id_jenis
        WHERE a.id_user='$userID'";
        return $query;
    }

    public function order_truck($iduser, $idkendaraan) {
        $query = "INSERT INTO detail_booking (id_user, id_truck, status) VALUES ('$iduser','$idkendaraan', '0')";
        return $query;
    }

    public function close_transaction($id_booking) {
        $query = "UPDATE detail_booking SET status='1' WHERE id_booking='$id_booking'";
        return $query;
    }

    // public function delete($id) {
    //     $query = "DELETE FROM detail_booking WHERE id_booking='$id'";
    //     return $query;
    // }

}

?>