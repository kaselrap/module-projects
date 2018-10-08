<?php

/**
 * Class Quiz
 */
class Quiz extends DB_Connect
{
    private $id;

    private $quiz;

    private $type;

    private $question;

    private $answersList;

    public function __construct(
        $dbo = NULL,
        $method = 'default',
        $id = null,
        $type = 'text',
        $question = null,
        $answersList = array()
    )
    {
        parent::__construct($dbo);

        switch ( $method ) {
            case 'load' :
                $this->quiz = R::load('quiz', $id);
                if( isset($type) && !empty($type) ) {
                    $this->quiz->type = $type;
                }
                if( isset($question) && !empty($question) ) {
                    $this->quiz->question = $question;
                }
                if( isset($answersList) && !empty($answersList) ) {
                    $this->quiz->answersList = $answersList;
                }
                break;

            default :
                $this->quiz = R::dispense('quiz');
                $this->quiz->date = time();
                $this->quiz->type = $type;
                $this->quiz->question = $question;
                $this->quiz->answersList = $answersList;
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->quiz->id;
    }

    /**
     * @return mixed
     */
    public function getAnswersList()
    {
        return $this->quiz->answersList;
    }

    /**
     * @param mixed $answersList
     */
    public function setAnswersList($answersList)
    {
        $this->quiz->answersList = $answersList;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->quiz->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->quiz->question = $question;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->quiz->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->quiz->type = $type;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
}