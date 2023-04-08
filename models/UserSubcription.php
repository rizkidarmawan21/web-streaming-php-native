<?php

require_once __DIR__ . './../connection/koneksi.php';

// Nyalakan Session
session_start();

class UserSubcription
{

    /**
     *  Save Transaksi in database
     * 
     *  Fungsi untuk melakukan checkout atau berlangganan
     */
    static function checkout($id_plan, $kode_unik, $midtrans)
    {
        $koneksi = koneksi();

        // Ambil data paket langganan
        $getSubcriptionPlan = self::getSubcriptionPlan($id_plan);
        $dataSubcriptionPlan = $getSubcriptionPlan->fetch();

        // Cari tanggal expired paket
        $today = date("Y-m-d");
        $expirate_date = date('Y-m-d', strtotime("+" . $dataSubcriptionPlan['active_period_in_month'] . " months", strtotime($today)));

        // Simpan data yang akan dimasukkan kedalam database
        $data = [
            $_SESSION['auth']['id'],
            $dataSubcriptionPlan['id_subcription_plan'],
            $kode_unik,
            $dataSubcriptionPlan['price'],
            $expirate_date,
            'pending',
            $midtrans->token,
            $midtrans->redirect_url,
        ];

        $sql  = "INSERT INTO user_subcription (`id_user`, `id_subcription_plan`, `code_unique`,`price`, `expirate_date`,`payment_status`,`snap_token`,`url_snap_redirect`) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $koneksi->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     *  Fungsi untuk mengambil data paket
    */
    static function getSubcriptionPlan($id)
    {
        $koneksi = koneksi();
        $sql = "SELECT * FROM subcription_plan WHERE id_subcription_plan=?";
        $stmt  = $koneksi->prepare($sql);
        $stmt->execute([$id]);

        return $stmt;
    }

    /**
     *  Fungsi untuk melakukan update status pembayaran apakah sukses, gagal, atau pending
    */
    static function updateStatus($kode_unik, $status)
    {
        $koneksi = koneksi();
        $sql = "UPDATE user_subcription SET payment_status = ? WHERE code_unique = ? ";
        $stmt  = $koneksi->prepare($sql);
        $stmt->execute([$status, $kode_unik]);

        return $stmt;
    }

    /**
     *  Fungsi untuk menghapus data berlangganan atau stop berlangganan
    */
    static function deleteUserSubcription($id){
        $koneksi = koneksi();
        $sql = "DELETE FROM `user_subcription` WHERE id_user_subcription = ? ";
        $stmt  = $koneksi->prepare($sql);
        $stmt->execute([$id]);

        return $stmt;
    }
}
