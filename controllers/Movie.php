<?php

require_once __DIR__ . './../models/Movie.php';
require_once __DIR__ . './../helpers/uploadImage.php';
require_once __DIR__ . './../helpers/flashMessage.php';

function movie($id)
{
    $data = Movie::getMovie($id);

    return $data;
}

function movieFeatured()
{
    $data = Movie::getMovieFeature();
    return $data;
}


// tambah data video/ film
function upload_movie()
{
    // Call helper upload file image
    $upload = uploadImage();

    if ($upload != false) {
        // save data in database
        $data = [
            htmlspecialchars($_POST['title']),
            htmlspecialchars($_POST['description']),
            htmlspecialchars($_POST['genre']),
            htmlspecialchars($_POST['is_feature'] == 'on' ? 1 : 0),
            htmlspecialchars($_POST['rating']),
            htmlspecialchars($_POST['year']),
            htmlspecialchars($_POST['link_movie']),
            "assets/images/$upload",
        ];


        $movie = Movie::uploadMovie($data);

        if ($movie) {
            Flasher::setFlash('Tambah movie baru berhasil.', 'berhasil', 'success');
            header('location: ../admin/dashboard-admin.php', true);
            exit;
        } else {
            Flasher::setFlash('Tambah movie baru gagal.', 'gagal', 'error');
            header('location: ../admin/dashboard-admin.php', true);
            exit;
        }
    }
}

// edit data film/video
function editMovie($id)
{
    $getMovie = Movie::getMovie($id);


    if ($_FILES["img_movie"]["name"] == '' or $_FILES["img_movie"]["name"] == null) {
        $upload = $getMovie['img_movie'];
    } else {
        unlink('../' . $getMovie['img_movie']);
        $upload = 'assets/images/'.uploadImage();
    }

    $data = [
        htmlspecialchars($_POST['title']),
        htmlspecialchars($_POST['description']),
        htmlspecialchars($_POST['genre']),
        htmlspecialchars($_POST['is_feature'] == 'on' ? 1 : 0),
        htmlspecialchars($_POST['rating']),
        htmlspecialchars($_POST['year']),
        htmlspecialchars($_POST['link_movie']),
        $upload,
        $getMovie['id_movie']
    ];

    $movie = Movie::editMovie($data);

    if ($movie) {
        Flasher::setFlash('Edit movie berhasil.', 'berhasil', 'success');
        header('location: ../admin/dashboard-admin.php', true);
        exit;
    } else {
        Flasher::setFlash('Edit movie baru gagal.', 'gagal', 'error');
        header('location: ../admin/dashboard-admin.php', true);
        exit;
    }
}

// hapus data film
function deleteMovie($id)
{
    $getMovie = Movie::getMovie($id);

    unlink('../' . $getMovie['img_movie']);

    $movie = Movie::deleteMovie($id);

    if ($movie) {
        Flasher::setFlash('Hapus movie baru berhasil.', 'berhasil', 'success');
        header('location: ../admin/dashboard-admin.php', true);
        exit;
    } else {
        Flasher::setFlash('Hapus movie baru gagal.', 'gagal', 'error');
        header('location: ../admin/dashboard-admin.php', true);
        exit;
    }
}
