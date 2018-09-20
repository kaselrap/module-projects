<?php

/**
 * Class Projects
 */
class Blocks extends DB_Connect
{
    private $id;

    private $block;

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
                $this->block = R::load('blocks', $id);
                break;

            default :
                $this->block = R::dispense('blocks');
                $this->block->date = time();
        }

    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->block->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->block->name;
    }

    public function __destruct()
    {
        $this->id = R::store($this->block);
    }
}