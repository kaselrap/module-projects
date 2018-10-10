<?php

/**
 * Class Article
 */
class Article extends DB_Connect
{

    private $id;

    private $article;

    private $text;

    public function __construct($dbo = NULL, $method = 'default', $id = null, $text = null)
    {
        parent::__construct($dbo);

        switch ( $method ) {
            case 'findOne' :
                $this->article = R::findOne(
                    'article','module_id = ?', [$id ]
                );
                break;
            case 'findByModuleId' :
                $this->article = R::findLike(
                    'article',
                    ['module_id' => [$id]],
                    'ORDER by `order` '
                );
                break;
            case 'load' :
                $this->article = R::load('article', $id);
                if( isset($text) && !empty($text) ) {
                    $this->article->text = $text;
                }
                break;

            default :
                $this->article = R::dispense('article');
                $this->article->date = time();
                $this->article->text = $text;

        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->article->id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->article->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->article->text = $text;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getArticle()
    {
        return $this->article;
    }
}