<?php

/**
 * Class HtmlCode
 */
class Html extends DB_Connect
{
    private $id;

    private $code;

    private $html;

    public function __construct($dbo = NULL, $method = 'default', $id = null, $html = null)
    {
        parent::__construct($dbo);

        switch ( $method ) {
            case 'findOne' :
                $this->code = R::findOne(
                    'code','module_id = ?', [$id ]
                );
                break;
            case 'findByModuleId' :
                $this->code = R::findLike(
                    'code',
                    ['module_id' => [$id]],
                    'ORDER by `order` '
                );
                break;
            case 'load' :
                $this->code = R::load('code', $id);
                if( isset($html) && !empty($html) ) {
                    $this->code->html = $html;
                }
                break;

            default :
                $this->code = R::dispense('code');
                $this->code->date = time();
                $this->code->html = $html;

        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->code->id;
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return $this->code->html;
    }

    /**
     * @param mixed $html
     */
    public function setHtml($html)
    {
        $this->code->html = $html;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getCode()
    {
        return $this->code;
    }
}