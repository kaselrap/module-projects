<?php
/**
 * Include necessary files
 */
include_once '../sys/core/init.inc.php';

session_start();

$data = $_POST;
if (isset($data['functionname']) && !empty($data['functionname'])) {
    switch ($data['functionname']) {
        case 'getParamsSlider' :

            break;
        case 'getAllImages' :
            $image = new Image(
                $dbo,
                'findAll'
            );
            echo json_encode($image->getImage());

            break;
        case 'quizAnswered':
            $ip_result = $_SERVER['REMOTE_ADDR'];
            $quiz = new Quiz(
                $dbo,
                'loadAnswer',
                $data['id']
            );
            $ip = new Ip(
                $dbo,
                'findOne',
                $quiz->getId()
            );
            if (!isset($ip->getIp()->ip) || $ip->getIp()->ip != $ip_result) {
                $ip = new Ip(
                    $dbo,
                    '',
                    null,
                    $ip_result
                );
                $quiz = new Quiz(
                    $dbo,
                    'loadAnswer',
                    $data['id'],
                    $data['vote'],
                    $ip->getIp()
                );
                $quiz->saveQuiz();
                $quiz->saveAnswer();
            }
            break;

        case 'deleteProject':
            $user = new User(
                $dbo,
                'load',
                $_SESSION['user_id']
            );
            var_dump($user);
            unset($user->getUser()->xownProjectList[$data['id']]);
            break;
        default:

    }
}