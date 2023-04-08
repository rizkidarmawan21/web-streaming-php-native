<?php

require_once __DIR__ . './../models/User.php';
require_once __DIR__ . './../helpers/flashMessage.php';

switch ($_GET['action']) {
    case 'login':
        login($_POST['email'], $_POST['password']);
        break;
    case 'logout':
        logout();
        break;
    case 'register':
        $request = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        register($request);
        break;
    default:
        logout();
        break;
}

/**
 * Login
 * 
 */
function login($email, $password)
{

    $data = User::login($email, $password);

    $count = $data->rowCount();
    if ($count > 0) {
        $user = $data->fetch();

        $_SESSION["auth"] = [
            "id" => $user['id_user'],
            "name" => $user['name'],
            "role" => $user['role'],
        ];

        // JIka user itu admin maka
        if ($user['role'] === 'admin') {
            header('location: ../admin/dashboard-admin.php', true);
            exit;
        } else {
            header('location: ../index.php', true);
            exit;
        }
    } else {
        Flasher::setFlash('Akun tidak ditemukan !', 'gagal', 'error');
        header('location: ../sign_in.php', true);
        exit;
    }
}

/**
 * Register
 * 
 */
function register($input)
{

    // check email is registered or not
    $data = User::getByEmail($input['email']);
    $count = $data->rowCount();
    if ($count > 0) {
        Flasher::setFlash('Email telah digunakan!, masukkan email lain.', 'gagal', 'error');
        header('location: ../sign_up.php', true);
        exit;
    } else {

        // check password have spaci or not
        if (preg_match('/\s/', $input['password'])) {

            Flasher::setFlash('Password tidak boleh menggunakan spasi!', 'gagal', 'error');
            header('location: ../sign_up.php', true);
            exit;
        } else {

            // check password more then 3 caracter or not
            if (strlen($input['password']) <= '3') {
                Flasher::setFlash('Password harus lebih dari 3 karakter!', 'gagal', 'error');
                header('location: ../sign_up.php', true);
                exit;
            } else {
                $register = User::register($input);
                if ($register) {
                    Flasher::setFlash('Pendaftaran akun anda berhasil, silahkan login untuk melanjutkan.', 'berhasil', 'success');
                    header('location: ../sign_in.php', true);
                    exit;
                } else {
                    Flasher::setFlash('Pendaftaran akun anda gagal, periksa kembali inputan anda dan tunggu beberapa saat.', 'gagal', 'error');
                    header('location: ../sign_up.php', true);
                    exit;
                }
            }
        }
    }
}

/**
 * Logout
 * 
 */
function logout()
{
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    header('location: ../index.php', true);
    exit;
}
