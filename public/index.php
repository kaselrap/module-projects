<?php

/*
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';

$project = new Projects($dbo);
$project->setName('New Project');
echo $project->getName() . PHP_EOL;

