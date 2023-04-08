<?php

require_once __DIR__ . './../connection/koneksi.php';

session_start();

class User
{

    /**
     * function for login
     * params email and password
     */
    static function login($email, $password)
    {
        $koneksi = koneksi();

        $sql = "SELECT * FROM user WHERE email = ? AND passw = ?";
        $stmt  = $koneksi->prepare($sql);
        $stmt->execute([$email, $password]);

        return $stmt;
    }

    static function getByEmail($email)
    {
        $koneksi = koneksi();
        $sql = "SELECT * FROM user WHERE email=?";
        $stmt  = $koneksi->prepare($sql);
        $stmt->execute([$email]);

        return $stmt;
    }

    static function getUserSubcription($id){
        $koneksi = koneksi();

        $today = date('Y-m-d');

        $sql = "SELECT * FROM user_subcription WHERE id_user = ? AND payment_status = 'paid' AND expirate_date >= '$today'";
        $stmt  = $koneksi->prepare($sql);
        $stmt->execute([$id]);

        return $stmt;
    }

    /**
     * function for register
     * params $data is data register name, email, and password
     */
    static function register($data)
    {
        $koneksi = koneksi();
        $sql  = "INSERT INTO user (`name`, `email`, `passw`, `role`) VALUES (?,?,?,?)";
        $stmt = $koneksi->prepare($sql);
        return $stmt->execute([$data['name'], $data['email'],$data['password'],'guest']);

    }
}
