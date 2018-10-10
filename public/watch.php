<?php

/**
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';

session_start();

if( isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ):
    $data = $_GET;
    $userId = $_SESSION['user_id'];

    $projects = new Projects(
        $dbo,
        'findProjectByUserId',
        $userId,
        $data['id']
    );
    $projectId = $projects->getId();
    $block = new Blocks(
        $dbo,
        'findByProjectId',
        $projectId
    );
    ?>
    <?php require_once 'components/header.php';?>
    <body class="watch">
        <div class="container">
            <?php foreach ($block->getBlock() as $block) : ?>
            <div class="row">

                <?php $module = new Module(
                    $dbo,
                    'findByBlockId',
                    $block->id
                );
                ?>

                <?php foreach ($module->getModule() as $module) : ?>
                    <div class="col-md-<?php echo $module->grid; ?> <?php echo $module->name; ?>">
                        <div class="<?php echo $module->name; ?>-inner">
                            <?php
                                switch ($module->name) {
                                    case 'slider' :
                                        $slider = new Slider(
                                            $dbo,
                                            'findOne',
                                            (int)$module->id
                                        );
                                        $imagesId = explode(',', $slider->getimageIds());
                                        $sliderImages = new Image(
                                            $dbo,
                                            'findByIds',
                                            $imagesId
                                        );

                                        ?>
                                        <div class="owl-carousel" <?php foreach ($slider->getSlider() as $key=>$value) {
                                            if ($key == 'id' || $key =='date' || $key == 'image_ids' || $key == 'module_id') {
                                            } else {
                                                echo 'data-'.str_replace('_','-',$key).'="'.$value.'"';
                                            }
                                        } ?>>

                                        <?php foreach ($sliderImages->getImage() as $image) : ?>
                                        <div class="slide">
                                            <a href="<?php echo $image->src; ?>">
                                                <img src="<?php echo (isset($image->src_preview))? $image->src_preview : $image->src; ?>" alt="<?php echo $image->alt; ?>">
                                            </a>
                                        </div>
                                        <?php endforeach; ?>
                                        </div>

                                        <?php
                                        break;
                                    case 'video' :
                                        $video = new Video(
                                            $dbo,
                                            'findOne',
                                            $module->id
                                        );
                                        ?>
                                        <div class="video-box">
                                            <?php echo $video->getIframe(); ?>
                                        </div>
                                        <?php
                                        break;

                                    case 'gallery' :
                                        $gallery = new Gallery(
                                            $dbo,
                                            'findOne',
                                            $module->id
                                        );
                                        $imagesId = explode(',', $gallery->getImageIds());
                                        $galleryImages = new Image(
                                            $dbo,
                                            'findByIds',
                                            $imagesId
                                        );
                                        ?>

                                        <?php foreach ($galleryImages->getImage() as $image) : ?>
                                        <div class="gallery-box">
                                            <a href="<?php echo $image->src; ?>">
                                                <img src="<?php echo (isset($image->src_preview))? $image->src_preview : $image->src; ?>" alt="<?php echo $image->alt; ?>">
                                            </a>
                                        </div>
                                        <?php endforeach; ?>

                                        <?php
                                        break;

                                    case 'article' :
                                        $article = new Article(
                                            $dbo,
                                            'findOne',
                                            $module->id
                                        );
                                        ?>

                                        <div class="articl-box">
                                            <?php echo $article->getText(); ?>
                                        </div>

                                        <?php
                                        break;

                                    case 'quiz' :
                                        $quiz = new Quiz(
                                            $dbo,
                                            'findOne',
                                            $module->id
                                        );
                                        $ip = new Ip(
                                            $dbo,
                                            'findOne',
                                            $quiz->getId()
                                        );
                                        $hasIp = isset($ip->getIp()->ip);
                                        if ( $hasIp ) {
                                            $answeredId = $ip->getIp()->answers_id;
                                            $sumVoted = 0;
                                        }
                                        ?>

                                        <div class="quiz-box <?php echo ($hasIp) ? 'answered' : ''; ?>">
                                            <h3 class="question">
                                                <?php echo $quiz->getQuestion(); ?>
                                            </h3>
                                            <div class="answers">
                                                <?php
                                                switch ($quiz->getType()) {
                                                    case 'image':
                                                        ?>
                                                        <?php
                                                            if($hasIp) {
                                                                foreach ($quiz->getAnswersList() as $answer) {
                                                                    $sumVoted += (int)$answer->vote;
                                                                }
                                                            }
                                                        ?>
                                                            <?php foreach ($quiz->getAnswersList() as $answer): ?>
                                                                <p class="answer image-answer <?php echo ($hasIp && $answer->id == $answeredId)? 'active' : ''; ?>" data-answer-id="<?php echo $answer->id; ?>"
                                                                   data-number-vote="<?php echo (isset($answer->vote))?$answer->vote:0; ?>">
                                                                    <a href="#"> <img src="<?php echo $answer->answer ?>" alt="Answer"> </a>
                                                                    <span class="percent">
                                                                        <?php
                                                                        if ($hasIp) {
                                                                            echo round((int)$answer->vote*100/$sumVoted) . '%';
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </p>
                                                            <?php endforeach; ?>
                                                        <?php
                                                        break;

                                                    default:
                                                        ?>
                                                        <?php
                                                        if($hasIp) {
                                                            foreach ($quiz->getAnswersList() as $answer) {
                                                                $sumVoted += (int)$answer->vote;
                                                            }
                                                        }
                                                        ?>
                                                        <?php foreach ($quiz->getAnswersList() as $answer): ?>
                                                        <p class="answer text-answer <?php echo ($hasIp && $answer->id == $answeredId)? 'active' : ''; ?>" data-answer-id="<?php echo $answer->id; ?>"
                                                           data-number-vote="<?php echo (isset($answer->vote))?$answer->vote:0; ?>">
                                                            <a href="#"> <?php echo $answer->answer; ?> </a>
                                                            <span class="percent">
                                                                <?php
                                                                if ($hasIp) {
                                                                    echo round((int)$answer->vote*100/$sumVoted) . '%';
                                                                }
                                                                ?>
                                                            </span>
                                                        </p>
                                                        <?php endforeach; ?>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <?php
                                        break;

                                    case 'logotype' :
                                        $logotype = new Logotype(
                                            $dbo,
                                            'findOne',
                                            $module->id
                                        );
                                        $imageLogo = new Image(
                                            $dbo,
                                            'load',
                                            $logotype->getImageId()
                                        );
                                        ?>

                                        <div class="logotype-box">
                                            <img src="<?php echo $imageLogo->getSrc(); ?>" alt="<?php echo $imageLogo->getAlt(); ?>">
                                        </div>

                                        <?php
                                        break;

                                    case 'html' :
                                        $html = new Html(
                                            $dbo,
                                            'findOne',
                                            $module->id
                                        );
                                        ?>

                                        <div class="html-box">
                                            <?php echo $html->getHtml(); ?>
                                        </div>

                                        <?php
                                        break;

                                    default:
                                }
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    <?php require_once 'components/footer.php';?>
    <?php else: ?>
    <?php header('Location: /'); ?>
<?php endif; ?>
