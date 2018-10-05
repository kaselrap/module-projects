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
        <div id="project" class="project">
            <div class="row block ui-sortable fill" data-row="12" data-offset-block="1">


                <div class="col-md-12 module" data-column="12" data-offset-module="1">
                    <div class="control">
                        <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>
                        <a href="#" class="edit-module"><i class="fa fa-cog"></i></a>
                        <a href="#" class="move-module"><i class="fa fa-bars"></i></a>
                    </div>                    <div class="module-block slider" data-module="slider" data-image-src="{&quot;optionList&quot;:{&quot;numberOfItems&quot;:&quot;1&quot;,&quot;margin&quot;:&quot;0&quot;,&quot;center&quot;:&quot;false&quot;,&quot;autoWidth&quot;:&quot;false&quot;,&quot;loop&quot;:&quot;true&quot;,&quot;autoplay&quot;:&quot;true&quot;,&quot;autoplayHoverPause&quot;:&quot;true&quot;,&quot;sliderSpeed&quot;:&quot;5000&quot;,&quot;sliderSpeedAnimation&quot;:&quot;600&quot;,&quot;navigation&quot;:&quot;false&quot;,&quot;pagination&quot;:&quot;false&quot;},&quot;listImages&quot;:[{&quot;id&quot;:0,&quot;idImage&quot;:&quot;2&quot;,&quot;src&quot;:&quot;https://loremflickr.com/320/240?lock=1&quot;,&quot;alt&quot;:&quot;alt&quot;},{&quot;id&quot;:1,&quot;idImage&quot;:&quot;8&quot;,&quot;src&quot;:&quot;https://loremflickr.com/320/240?lock=7&quot;,&quot;alt&quot;:&quot;alt&quot;},{&quot;id&quot;:2,&quot;idImage&quot;:&quot;9&quot;,&quot;src&quot;:&quot;https://loremflickr.com/320/240?lock=8&quot;,&quot;alt&quot;:&quot;alt&quot;},{&quot;id&quot;:3,&quot;idImage&quot;:&quot;10&quot;,&quot;src&quot;:&quot;https://loremflickr.com/320/240?lock=9&quot;,&quot;alt&quot;:&quot;alt&quot;},{&quot;id&quot;:4,&quot;idImage&quot;:&quot;15&quot;,&quot;src&quot;:&quot;https://loremflickr.com/320/240?lock=14&quot;,&quot;alt&quot;:&quot;alt&quot;},{&quot;id&quot;:5,&quot;idImage&quot;:&quot;16&quot;,&quot;src&quot;:&quot;https://loremflickr.com/320/240?lock=15&quot;,&quot;alt&quot;:&quot;alt&quot;}]}">slider</div>
                </div>
            </div>
            <div class="row block ui-sortable fill" data-row="12" data-offset-block="2">
                <div class="col-md-6 module" data-column="6" data-offset-module="1">
                    <div class="control">
                        <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>
                        <a href="#" class="edit-module"><i class="fa fa-cog"></i></a>
                        <a href="#" class="move-module ui-sortable-handle"><i class="fa fa-bars"></i></a>
                    </div>                    <div class="module-block video" data-module="video" data-iframe="{&quot;iframe&quot;:&quot;iframe video link&quot;}">video</div>
                </div><div class="col-md-6 module" data-column="6" data-offset-module="2">
                    <div class="control">
                        <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>
                        <a href="#" class="edit-module"><i class="fa fa-cog"></i></a>
                        <a href="#" class="move-module ui-sortable-handle"><i class="fa fa-bars"></i></a>
                    </div>                    <div class="module-block gallery" data-module="gallery" data-image-src="{&quot;optionList&quot;:{},&quot;listImages&quot;:&quot;[{\&quot;id\&quot;:0,\&quot;idImage\&quot;:\&quot;10\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=9\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:1,\&quot;idImage\&quot;:\&quot;11\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=10\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:2,\&quot;idImage\&quot;:\&quot;15\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=14\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:3,\&quot;idImage\&quot;:\&quot;16\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=15\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:0,\&quot;idImage\&quot;:\&quot;10\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=9\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:1,\&quot;idImage\&quot;:\&quot;11\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=10\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:2,\&quot;idImage\&quot;:\&quot;15\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=14\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:3,\&quot;idImage\&quot;:\&quot;16\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=15\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:0,\&quot;idImage\&quot;:\&quot;10\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=9\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:1,\&quot;idImage\&quot;:\&quot;11\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=10\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:2,\&quot;idImage\&quot;:\&quot;15\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=14\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;},{\&quot;id\&quot;:3,\&quot;idImage\&quot;:\&quot;16\&quot;,\&quot;src\&quot;:\&quot;https://loremflickr.com/320/240?lock=15\&quot;,\&quot;alt\&quot;:\&quot;alt\&quot;}]&quot;}">gallery</div>
                </div>
            </div>
            <div class="row block ui-sortable fill" data-row="12" data-offset-block="3">
                <div class="col-md-4 module" data-column="4" data-offset-module="1">
                    <div class="control">
                        <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>
                        <a href="#" class="edit-module"><i class="fa fa-cog"></i></a>
                        <a href="#" class="move-module ui-sortable-handle"><i class="fa fa-bars"></i></a>
                    </div>                    <div class="module-block article" data-module="article" data-html="{&quot;html&quot;:&quot;<p>Adaasc</p><p>as</p><p>ca</p><p>s</p><p>ca</p><p>sc</p><p>a</p>&quot;}">article</div>
                </div><div class="col-md-4 module" data-column="4" data-offset-module="2">
                    <div class="control">
                        <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>
                        <a href="#" class="edit-module"><i class="fa fa-cog"></i></a>
                        <a href="#" class="move-module ui-sortable-handle"><i class="fa fa-bars"></i></a>
                    </div>                    <div class="module-block quiz" data-module="quiz" data-quiz="{&quot;answersList&quot;:{&quot;0&quot;:&quot;ans1&quot;,&quot;1&quot;:&quot;ans2&quot;,&quot;2&quot;:&quot;ans3&quot;},&quot;type&quot;:&quot;text&quot;,&quot;question&quot;:&quot;qeus&quot;}">quiz</div>
                </div><div class="col-md-4 module" data-column="4" data-offset-module="3">
                    <div class="control">
                        <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>
                        <a href="#" class="edit-module"><i class="fa fa-cog"></i></a>
                        <a href="#" class="move-module ui-sortable-handle"><i class="fa fa-bars"></i></a>
                    </div>                    <div class="module-block logotype" data-module="logotype" data-logotype="[{&quot;id&quot;:&quot;36&quot;,&quot;src&quot;:&quot;https://loremflickr.com/320/240?lock=35&quot;,&quot;alt&quot;:&quot;alt&quot;}]">logotype</div>
                </div>
            </div>
            <div class="row block ui-sortable fill" data-row="12" data-offset-block="4">

                <div class="col-md-12 module" data-column="12" data-offset-module="1">
                    <div class="control">
                        <a href="#" class="remove-block"><i class="fas fa-trash"></i></a>
                        <a href="#" class="edit-module"><i class="fa fa-cog"></i></a>
                        <a href="#" class="move-module ui-sortable-handle"><i class="fa fa-bars"></i></a>
                    </div>                    <div class="module-block html" data-module="html" data-html="{&quot;code&quot;:&quot;gdgdfgd&quot;}">html</div>
                </div></div>
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
