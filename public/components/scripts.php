<?php
$scripts = array(
    "./assets/libs/jquery-3.3.1.min.js",
    "./assets/libs/jquery-ui.min.js",
    "https://cdn.quilljs.com/1.3.6/quill.js",
    "./assets/js/script.js"
);
echo "<script src='./assets/libs/baguetteBox/baguetteBox.min.js' async></script>";

foreach ($scripts as $script) {
    echo "<script src='$script'></script>";
}

