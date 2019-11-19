<?php

function store($files, $path, $studentID, $documentName) {

    // Start of physically moving file to its destination
    $fileName = time().$files[$documentName]["name"];

    // rename the picture
    $image_name = $studentID.'-'.$documentName;

    // destination path
    $destination = $path.basename($image_name.'.jpg');

    // move and upload
    move_uploaded_file($files[$documentName]['tmp_name'], $destination);

    // rename the file name
    $documentName = $image_name.'.jpg';

    return $documentName;
}






function isImage($files, $imageFile) {

    // Check if its an image
    $check_if_image = getimagesize($files["$imageFile"]["tmp_name"]);

    // check weather uploaded an image or another file
    if ($check_if_image !== false) {
        return true;
    } else {
        return false;
    }
}



function isUpload($files, $imageFile) {
    if ($files[$imageFile]["size"] > 0) {
        return true;
    } else {
        return false;
    }
}
