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

$project = new Projects(
    $dbo,
    'default',
    null,
    'New Project with Block and Three Module'
);
$block1 = new Blocks($dbo);
    $module1 = new Module(
        $dbo,
        'default',
        null,
        'slider',
        4
    );
        $slider1 = new Slider(
            $dbo,
            'default',
            null,
            '[6,9,10]'
        );
        $module1->setModuleList($slider1->getSlider());
    $module2 = new Module(
        $dbo,
        'default',
        null,
        'slider',
        4
    );
        $slider2 = new Slider(
            $dbo,
            'default',
            null,
            '[6,7,8]'
        );
        $module2->setModuleList($slider2->getSlider());
    $module3 = new Module(
        $dbo,
        'default',
        null,
        'slider',
        4
    );
        $slider3 = new Slider(
            $dbo,
            'default',
            null,
            '[3,4,5]'
        );
        $module3->setModuleList($slider3->getSlider());
    $block1->setModule($module1->getModule());
    $block1->setModule($module2->getModule());
    $block1->setModule($module3->getModule());

$block2 = new Blocks($dbo);
    $module = new Module(
        $dbo,
        'default',
        null,
        'slider',
        12
    );
        $slider = new Slider(
            $dbo,
            'default',
            null,
            '[1,2,3,4,5]'
        );
        $module->setModuleList($slider->getSlider());
    $block2->setModule($module->getModule());

$project->setBlock($block1->getBlock());
$project->setBlock($block2->getBlock());

$user->setProject($project->getProject());
