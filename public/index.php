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
                <div class="project-inner">
                    <h3>
                        <?php echo $project->name; ?>
                    </h3>
                    <div class="switch-panel">
                        <a href="/watch.php?id=<?php echo $project->id; ?>" class="watch-project">
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="#" class="remove-project" data-id-project="<?php echo $project->id; ?>">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'components/footer.php';?>
