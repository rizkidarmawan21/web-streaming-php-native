<?php

require_once __DIR__ . './../connection/koneksi.php';

class Movie
{
    static function getMovie($id)
    {
        $koneksi = koneksi();

        if ($id != null or $id != '') {
            $sql = "SELECT * FROM movie WHERE id_movie = ? ";
            $stmt  = $koneksi->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->fetch();
        } else {
            $sql = "SELECT * FROM movie";
            return $koneksi->query($sql);
        }
    }

    static function getMovieFeature()
    {
        $koneksi = koneksi();

        $sql = "SELECT * FROM movie WHERE is_feature = 1";
        return $koneksi->query($sql);
    }

    static function uploadMovie($data)
    {

        $koneksi = koneksi();
        $sql = "INSERT INTO movie (`title`, `description`, `genre`, `is_feature`, `rating`, `year`, `link_movie`, `img_movie`) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $koneksi->prepare($sql);

        return $stmt->execute($data);
    }

    static function editMovie($data)
    {

        $koneksi = koneksi();
        $sql = "UPDATE movie SET title = ? , description = ? , genre = ? , is_feature = ? , rating = ? , year = ? , link_movie = ? ,img_movie = ? WHERE id_movie = ?";
        $stmt = $koneksi->prepare($sql);

        return $stmt->execute($data);
    }

    static function deleteMovie($id)
    {
        $koneksi = koneksi();
        $sql = "DELETE FROM `movie` WHERE id_movie = ? ";
        $stmt  = $koneksi->prepare($sql);
        $stmt->execute([$id]);

        return $stmt;
    }
}
