<?php

/**
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';

session_start();

if( isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ):
?>
<?php require_once 'components/header.php';?>
<body class="project-page">
    <div class="container">
        <div class="column-examples">
            <div class="row">
                <div class="col-md-1 column" data-column="12">1/1</div>
                <div class="col-md-1 column" data-column="6">1/2</div>
                <div class="col-md-1 column" data-column="4">1/3</div>
                <div class="col-md-1 column" data-column="3">1/4</div>
                <div class="col-md-1 column" data-column="2">1/6</div>
                <div class="col-md-1 column" data-column="8">2/3</div>
                <div class="col-md-1 column" data-column="9">3/4</div>
                <div class="col-md-1 save-project">Save</div>
            </div>
        </div>
        <div class="project-name">
            <input type="text">
        </div>
        <div id="project" class="project">
        </div>
        <div class="add-new">
            <a href="#" id="addSection"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="modal-window container">
        <div class="modal-window-inner">
            <a href="#" class="close-modal">
                <i class="fas fa-times"></i>
            </a>
            <select name="module" class="select-module">
                <option value="slider">Slider</option>
                <option value="video">Video</option>
                <option value="gallery">Gallery</option>
                <option value="article">Article</option>
                <option value="quiz">Quiz</option>
                <option value="logotype">Logotype</option>
                <option value="html">HTML code</option>
            </select>
            <div class="modal-module">

            </div>
            <div class="add-modal-module">
                <a href="#" class="add-module-button">Insert Module</a>
            </div>
        </div>
    </div>
    <div class="window-images">
        <div class="modal-window-inner container">
            <a href="#" class="close-window-images">
                <i class="fas fa-times"></i>
            </a>
            <a href="#" class="add-images-to-module">Add Images</a>
            <div class="select-images">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row list-images">
                            <div class="spinner"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="ajax-uploader" class="ajax-uploader">
                            <div class="ajax-uploader-inner">
                                <ul class="file-list">
                                </ul>
                                <p >
                                    Choose or drop files here
                                </p>
                            </div>
                            <input class="ajax-file" id="ajax-file" type="file" name="images[]" multiple>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
<?php require_once 'components/footer.php';?>
<?php else: ?>
<?php header('Location: /'); ?>
<?php endif; ?>
