<?php

/**
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';

$user = new User(
    $dbo,
    'load',
    1
);


$projects = new Projects(
    $dbo,
    'findByUserId',
    $user->getId()
);


//var_dump($projects->getProject());
//
//$project = new Projects(
//    $dbo,
//    'default',
//    null,
//    'New Project with Block and Three Module'
//);
//$block1 = new Blocks($dbo);
//    $module1 = new Module(
//        $dbo,
//        'default',
//        null,
//        'slider',
//        4
//    );
//        $slider1 = new Slider(
//            $dbo,
//            'default',
//            null,
//            '[6,9,10]'
//        );
//        $module1->setModuleList($slider1->getSlider());
//    $module2 = new Module(
//        $dbo,
//        'default',
//        null,
//        'slider',
//        4,
//    );
//        $slider2 = new Slider(
//            $dbo,
//            'default',
//            null,
//            '[6,7,8]'
//        );
//        $module2->setModuleList($slider2->getSlider());
//    $module3 = new Module(
//        $dbo,
//        'default',
//        null,
//        'slider',
//        4
//    );
//        $slider3 = new Slider(
//            $dbo,
//            'default',
//            null,
//            '[3,4,5]'
//        );
//        $module3->setModuleList($slider3->getSlider());
//    $block1->setModule($module1->getModule());
//    $block1->setModule($module2->getModule());
//    $block1->setModule($module3->getModule());
//
//$block2 = new Blocks($dbo);
//    $module = new Module(
//        $dbo,
//        'default',
//        null,
//        'slider',
//        12
//    );
//        $slider = new Slider(
//            $dbo,
//            'default',
//            null,
//            '[1,2,3,4,5]'
//        );
//        $module->setModuleList($slider->getSlider());
//    $block2->setModule($module->getModule());
//
//$project->setBlock($block1->getBlock());
//$project->setBlock($block2->getBlock());
//
//$user->setProject($project->getProject());

$images = new Image(
    $dbo,
    'find',
    null,
    null,
    null,
    true,
    '10'
);

?>

<?php require_once 'components/header.php';?>
<body>
<header>
    <div class="container">
        <a href="/project.php">Create Project</a>
    </div>
</header>
<div class="container">
    <div class="row">
        <?php foreach ($projects->getProject() as $project) : ?>
            <div class="project col-md-3">
                <p>
                    <?php echo $project->name; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="container">
    <div class="logotype">
        <i class="fas fa-camera photos"></i>
<!--        <img src="./assets/images/2018/10/02/main_Снимок экрана от 2018-09-28 17-42-39._1538497224.png" alt="">-->
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="quiz col-md-8" data-type="text">
            <p>Question</p>
            <p class="question">
                <input type="text" name="question" class="question">
            </p>
            <div class="answers">
                <p>Poll options</p>
                <div class="answers-list">
                    <p class="answer">
                        <input type="text" name="answer[]">
                        <i class="fas fa-times remove-answer"></i>
                    </p>
                    <p class="answer">
                        <input type="text" name="answer[]">
                        <i class="fas fa-times remove-answer"></i>
                    </p>
                </div>
                <p class="add-an-option">
                    <input type="button" name="add-option" value="Add an option">
                </p>
            </div>
        </div>
        <div class="switcher col-md-4">
            <div class="switcher-inner">
                <a href="#" class="text-quiz active" data-type="text">Text</a>
                <a href="#" class="image-quiz" data-type="image">Image</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="select-images">
        <div class="row">
            <div class="col-md-8">
                <div class="row list-images">
                    <?php foreach ($images->getImage() as $image) : ?>
                        <div class="image col-md-2">
                            <div class="image-inner">
                                <i class="fas fa-check-circle check"></i>
                                <a href="<?php echo $image->src; ?>" data-caption="<?php echo $image->alt; ?>">
                                    <img src="<?php echo
                                    (isset($image->srcPreview)
                                        &&
                                    !empty($image->srcPreview)) ?
                                        $image->srcPreview :
                                        $image->src; ?>" alt="<?php echo $image->alt; ?>">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
<div class="container">

</div>
<?php require_once 'components/footer.php';?>
