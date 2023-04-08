<?php

/**
 * Flasher for alert
 */
class Flasher
{
    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION["flash"] = [
            "pesan" => $pesan,
            "aksi" => $aksi,
            "tipe" => $tipe
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION["flash"])) {
            switch ($_SESSION["flash"]['tipe']) {
                case 'error':
                    echo '<div class="relative py-3 pl-4 pr-10 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
                                <p>' . $_SESSION["flash"]['pesan'] . '</p>
                          </div>';
                    break;
                case 'success':
                    echo '<div class="relative py-3 pl-4 pr-10 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
                                <p>' . $_SESSION["flash"]['pesan'] . '</p>
                          </div>';
                    break;

                default:
                    echo '<div class="relative py-3 pl-4 pr-10 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
                                <p>' . $_SESSION["flash"]['pesan'] . '</p>
                          </div>';
                    break;
            }

            unset($_SESSION["flash"]);
        }
    }
}
