<?php

function uploadImage(){
    $target_dir = "../assets/images/";
    $nameFile = basename($_FILES["img_movie"]["name"]);
    
    $typeImage = explode('.',$nameFile);
    $typeImage = strtolower(end($typeImage)); 

    if( !in_array($typeImage,['jpg','jpeg','png']) ){
        echo "<script>alert('Yang anda upload bukan gambar!')</script>";

        return false;
    }
    
    $newFilenameImage = uniqid();
    $newFilenameImage .= '.';
    $newFilenameImage .= $typeImage;

    $target_file = $target_dir . $newFilenameImage;

    move_uploaded_file($_FILES["img_movie"]["tmp_name"],$target_file);

    return $newFilenameImage;
}