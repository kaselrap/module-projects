<?php
/**
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';

$data = $_POST;
if (isset($data['functionname']) && !empty($data['functionname'])) {
    switch ($data['functionname']) {
        case 'getParamsSlider' :

            break;
        case 'getAllImages' :
            $image = new Image(
                $dbo,
                'findAll'
            );
            echo json_encode($image->getImage());
            break;
    }
}