<?php
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
        <div id="project" class="project">
            <div class="row block fill" data-row="12" data-offset-block="1">
                <div class="col-md-12 module" data-column="12" data-offset-module="1">
                    <div class="control">
                        <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>
                        <a href="#" class="edit-module"><i class="fa fa-cog"></i></a>
                        <a href="#" class="move-module"><i class="fa fa-bars"></i></a>
                    </div>
                    <div class="none">
                        <a href="#" class="add-module"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
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
            <select name="module">
                <option value="slider">Slider</option>
                <option value="video">Video</option>
                <option value="gallery">Gallery</option>
                <option value="article">Article</option>
                <option value="quiz">Quiz</option>
                <option value="logotype">Logotype</option>
                <option value="html-code">HTML code</option>
            </select>
            <div class="modal-module">

            </div>
        </div>
    </div>
    <div class="overlay"></div>
<?php require_once 'components/footer.php';?>
<?php else: ?>
<?php header('Location: /'); ?>
<?php endif; ?>
