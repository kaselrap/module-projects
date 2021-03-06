<?php

function image_resize(
    $source_path,
    $destination_path,
    $destination_file,
    $newwidth,
    $newheight = FALSE,
    $quality = FALSE,
    $dir = ''
) {

    $ds          = DIRECTORY_SEPARATOR;

    ini_set("gd.jpeg_ignore_warning", 1); // иначе на некотоых jpeg-файлах не работает

    list($oldwidth, $oldheight, $type) = getimagesize($source_path);

    switch ($type) {
        case IMAGETYPE_JPEG: $typestr = 'jpeg'; break;
        case IMAGETYPE_GIF: $typestr = 'gif' ;break;
        case IMAGETYPE_PNG: $typestr = 'png'; break;
    }
    $function = "imagecreatefrom$typestr";
    $src_resource = $function($source_path);

    if (!$newheight) { $newheight = round($newwidth * $oldheight/$oldwidth); }
    elseif (!$newwidth) { $newwidth = round($newheight * $oldwidth/$oldheight); }
    $destination_resource = imagecreatetruecolor($newwidth,$newheight);

    imagecopyresampled($destination_resource, $src_resource, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);

    if ($type = 2) { # jpeg
        imageinterlace($destination_resource, 1);
        imagejpeg($destination_resource, $destination_path);
        return true;
    }
    else { # gif, png
        $function = "image$typestr";
        $function($destination_resource, $destination_path);
        return true;
    }

    imagedestroy($destination_resource);
    imagedestroy($src_resource);
}