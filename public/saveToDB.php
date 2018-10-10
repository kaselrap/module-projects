<?php
/**
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';

session_start();

$errors = array();

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $data = $_POST;
    $userId = $_SESSION['user_id'];
    if(isset($data) && !empty($data)) {
        $user = new User(
            $dbo,
            'load',
            $userId
        );

        $projectsJson = json_decode($data['data']);
        if ( isset($projectsJson[0]->name) && !empty($projectsJson[0]->name) ) {
            $project = new Projects(
                $dbo,
                'default',
                null,
                null,
                $projectsJson[0]->name
            );
        } else {
            $errors[] = 'No typed project name';
        }
        if ( count($projectsJson) == 1 ) {
            $errors[] = 'no block selected';
        }
        foreach ($projectsJson as $projectJson){
            if ( !isset($projectJson->name) && isset($projectJson->blockId)) {
                $block = new Blocks(
                    $dbo,
                    '',
                    null,
                    $projectJson->blockId
                );
                if (empty($projectJson->module)) {
                    $errors[] = 'no module selected';
                } else {
                    foreach ($projectJson->module as $moduleJson) {
                        if ( !empty($moduleJson) ) {
                            $module = new Module(
                                $dbo,
                                'default',
                                null,
                                $moduleJson->name,
                                $moduleJson->column,
                                $moduleJson->offset
                            );
                            switch ($moduleJson->name) {
                                case 'slider':
                                    $imageList = [];
                                    foreach ($moduleJson->imageList as $image) {
                                        $imageList[] = (int)$image->idImage;
                                    }
                                    $imageList = implode(',', $imageList);
                                    $slider = new Slider(
                                        $dbo,
                                        'default',
                                        null,
                                        $imageList,
                                        $moduleJson->optionList
                                    );
                                    $module->setModuleList($slider->getSlider());
                                    break;

                                case 'video':
                                    $video = new Video(
                                        $dbo,
                                        '',
                                        null,
                                        $moduleJson->iframe
                                    );
                                    $module->setModuleList($video->getVideo());
                                    break;

                                case 'gallery':
                                    $imageList = [];
                                    foreach ($moduleJson->imageList as $image) {
                                        $imageList[] = (int)$image->idImage;
                                    }
                                    $imageList = '[' . implode(',', $imageList) . ']';
                                    $gallery = new Gallery(
                                        $dbo,
                                        'default',
                                        null,
                                        $imageList
                                    );
                                    $module->setModuleList($gallery->getGallery());

                                    break;

                                case 'article':
                                    $article = new Article(
                                        $dbo,
                                        'default',
                                        null,
                                        $moduleJson->article
                                    );
                                    $module->setModuleList($article->getArticle());

                                    break;

                                case 'quiz':
                                    $quiz = new Quiz(
                                        $dbo,
                                        'default',
                                        null,
                                        $moduleJson->typeQuiz,
                                        $moduleJson->question,
                                        $moduleJson->answers
                                    );
                                    $module->setModuleList($quiz->getQuiz());

                                    break;

                                case 'logotype':
                                    $logotype = new Logotype(
                                        $dbo,
                                        'default',
                                        null,
                                        $moduleJson->logotype[0]->id
                                    );
                                    $module->setModuleList($logotype->getLogotype());

                                    break;

                                case 'html':
                                    $html = new Html(
                                        $dbo,
                                        'default',
                                        null,
                                        $moduleJson->html
                                    );
                                    $module->setModuleList($html->getCode());

                                    break;

                                default:

                            }

                            $block->setModule($module->getModule());
                        }
                    }
                }
                $project->setBlock($block->getBlock());
            } else if (!isset($projectJson->name) && !isset($projectJson->blockId)) {
                $errors[] = 'no block selected';
            } else if (isset($projectJson->name)) {

            } else {
                $errors[] = 'no block selected';
            }
        }
        if ( empty($errors) ) {
            $user->setProject($project->getProject());
            echo 'success';
        } else {
            echo reset($errors);
        }
    }
}