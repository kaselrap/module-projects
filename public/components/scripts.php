<?php
$scripts = array(
    "./assets/libs/jquery-3.3.1.min.js",
    "./assets/libs/jquery-ui.min.js",
    "./assets/js/script.js"
);

foreach ($scripts as $script) {
    echo "<script src='$script'></script>";
}

