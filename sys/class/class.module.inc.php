<?php

/**
 * Class Module
 */
class Module extends DB_Connect
{
    private $id;

    private $module;

    private static $order;

    private $grid;

    private $name;

    /**
     * Module constructor.
     * @param null $dbo
     * @param string $method
     * @param null $id
     * @param null $name
     * @param null $grid
     */
    public function __construct($dbo = NULL, $method = 'default', $id = null, $name = null, $grid = null, $order = null)
    {
        /**
         * Call the parent constructor to check for
         * a database object
         */
        parent::__construct($dbo);

        switch ( $method ) {
            case 'findByBlockId' :
                $this->module = R::findLike(
                    'module',
                    ['block_id' => [$id]],
                    'ORDER by `order` '
                );
                break;
            case 'load' :
                $this->module = R::load('module', $id);
                if( isset($name) && !empty($name) ) {
                    $this->module->name = mb_strtolower($name);
                }
                if( isset($grid) && !empty($grid) ) {
                    $this->module->grid = $grid;
                }
                if( isset($order) && !empty($order) ) {
                    $this->module->order = $order;
                }
                break;

            default :
                $this->module = R::dispense('module');
                $this->module->date = time();
                $this->module->name = mb_strtolower($name);
                $this->module->grid = $grid;
                $this->module->order = $order;
        }

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->module->id;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @return mixed
     */
    public function getGrid()
    {
        return $this->module->grid;
    }

    /**
     * @param mixed $grid
     */
    public function setGrid($grid)
    {
        $this->module->grid = $grid;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->module->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->module->name = $name;
    }

    /**
     * @param mixed $order
     */
    public static function changeOrder($order)
    {
        $this->block->order = $order;
    }

    /**
     * @param $typeModule
     */
    public function setModuleList($typeModule)
    {
        $this->module->xownTypeList[] = $typeModule;
    }

    /**
     * @return mixed
     */
    public function getModuleList()
    {
        return $this->module->xownTypeList;
    }
}