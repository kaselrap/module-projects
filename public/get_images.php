<?php

/**
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';

$data = $_POST;
if ( isset($data) ) {
    $image = new Image(
        $dbo,
        'findByIds',
        $data['id']
    );
    echo json_encode($image->getImage());
}