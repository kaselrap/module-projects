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

    private $answers;

    private $save = false;

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
            case 'findByModuleId' :
                $this->quiz = R::findLike(
                    'quiz',
                    ['module_id' => [$id]],
                    'ORDER by `order` '
                );
                break;
            case 'findOne' :
                $this->quiz = R::findOne(
                    'quiz','module_id = ?', [$id ]
                );
                $this->answers = R::findOne(
                    'answers','quiz_id = ?', [$this->quiz->id]
                );
                break;
            case 'load' :
                $this->quiz = R::load('quiz', $id);
                if( isset($type) && !empty($type) ) {
                    $this->quiz->type = $type;
                }
                if( isset($question) && !empty($question) ) {
                    $this->quiz->question = $question;
                }
                break;
            case 'loadAnswer' :
                $this->answers = R::load('answers', $id);
                $this->quiz = R::load('quiz',$this->answers->quizId);
                if (isset($type) && !empty($type)) {
                    $this->answers->vote = $type;
                }
                if ( isset($question) && !empty($question) ) {
                    $this->quiz->xownIpList[] = $question;
                    $this->answers->xownIpList[] = $question;
                }
                break;
            default :
                $this->quiz = R::dispense('quiz');
                $this->quiz->date = time();
                $this->quiz->type = $type;
                $this->quiz->question = $question;
                foreach ($answersList as $key=>$answer) {
                    $this->answers = R::dispense('answers');
                    $this->answers->date = time();
                    $this->answers->answer =  $answer;
                    $this->quiz->xownAnswersList[] = $this->answers;
                }

        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->quiz->id;
    }

    public function getAnswerId()
    {
        return $this->answers->id;
    }

    /**
     * @return mixed
     */
    public function getVote () {
        return $this->answers->vote;
    }

    /**
     * @param $vote
     */
    public function setVote($vote)
    {
        $this->answers->vote = $vote;
    }

    /**
     * @return mixed
     */
    public function getAnswersList()
    {
        return $this->quiz->xownAnswersList;
    }

    /**
     * @param mixed $answersList
     */
    public function setAnswersList($answersList)
    {
        $this->quiz->xownAnswersList[] = $this->answers;
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
    public function saveQuiz() {
        R::store($this->quiz);
    }
    public function saveAnswer() {
        R::store($this->answers);
    }
    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getAnswers()
    {
        return $this->answers;
    }
    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
}