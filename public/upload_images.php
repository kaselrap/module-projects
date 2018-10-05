<?php

/**
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';
require_once 'components/resize.php';
$date = date("Y-m-d");
$date = explode("-", $date);
if ( isset($_FILES['files'])) {
    $errors 	  = array();
    $previews     = array();
    $files        = $_FILES['files'];
    $filesName    = $files['name'];
    $filesTmpName = $files['tmp_name'];
    for ($i=0; $i < count($files['name']); $i++) {
        $sourcePath = $_FILES['files']['tmp_name'][$i];
        $imageFileType = pathinfo($_FILES['files']['name'][$i],PATHINFO_EXTENSION);
        $fileName = str_replace($imageFileType,'', $_FILES['files']['name'][$i]);
        $targetFolder = $_SERVER['DOCUMENT_ROOT'] . "/assets/images/". $date[0] . '/' . $date[1] . '/' . $date[2] . '/';
        $mainImage = "/assets/images/". $date[0] . '/' . $date[1] . '/' . $date[2] . '/' . 'main_' . $fileName .'_' . time() . '.' . $imageFileType;
        $previewImage = "/assets/images/". $date[0] . '/' . $date[1] . '/' . $date[2] . '/' . 'preview_' . $fileName .'_' . time() . '.' . $imageFileType;

        if( !file_exists($targetFolder) ) {
            mkdir($targetFolder, 0777, true);
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $errors[] = 'Bad File Types';
        } else {
            if (
                image_resize(
                    $sourcePath,
                    $_SERVER['DOCUMENT_ROOT'] . $previewImage,
                    '//' . $_SERVER['HTTP_HOST'] . $previewImage,
                    320)
                &&
                move_uploaded_file(
                    $sourcePath,
                    $_SERVER['DOCUMENT_ROOT'] . $mainImage
                )
            ){
                chmod($targetFolder, 0777);
                $image = new Image(
                    $dbo,
                    '',
                    null,
                    array(
                        'main' => '//' . $_SERVER['HTTP_HOST'] . $mainImage,
                        'preview' => '//' . $_SERVER['HTTP_HOST'] . $previewImage
                    ),
                    $_FILES['files']['name'][$i]
                );
                $image->save();
                $previews[$i]['src'] = '//' . $_SERVER['HTTP_HOST'] . $previewImage;
                $previews[$i]['alt'] = $fileName;
                $previews[$i]['id'] = $image->getId();
            }
        }
    }
    if ( empty($errors) ) {
        echo json_encode($previews);
    }
}
