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
//        4
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

<?php require_once 'components/footer.php';?>
