<?php

/**
 * Class Blocks
 */
class Blocks extends DB_Connect
{
    private $id;

    private $block;

    private static $order;

    /**
     * Projects constructor.
     * @param null $dbo
     * @param string $method
     * @param null $id
     */
    public function __construct($dbo = NULL, $method = 'default', $id = null)
    {
        /**
        * Call the parent constructor to check for
        * a database object
        */
        parent::__construct($dbo);


        switch ( $method ) {
            case 'load' :
                $this->block = R::load('block', $id);
                break;

            default :
                $this->block = R::dispense('block');
                $this->block->date = time();
                $this->block->order = $this->orderIncrement();
        }

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->block->id;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @param mixed $order
     */
    public static function changeOrder($order)
    {
        $this->block->order = $order;
    }

    /**
     * @return int
     */
    public function orderIncrement () {
        return ++self::$order;
    }

    /**
     * @param $module
     */
    public function setModule($module)
    {
        $this->block->ownBlockList[] = $module;
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->block->ownBlockList;
    }

}