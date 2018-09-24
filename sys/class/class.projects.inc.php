<?php

/**
 * Class Projects
 */
class Projects extends DB_Connect
{
    private $id;

    private $project;

    /**
     * Projects constructor.
     * @param null $dbo
     * @param string $method
     * @param null $id
     */
    public function __construct($dbo = NULL, $method = 'default', $id = null, $name = null)
    {
        /**
        * Call the parent constructor to check for
        * a database object
        */
        parent::__construct($dbo);

        switch ( $method ) {
            case 'findByUserId' :
                $this->project = R::find('project', 'user_id LIKE ?', array($id));
                $this->save = false;
                break;
            case 'load' :
                $this->project = R::load('project', $id);
                break;

            default :
                $this->project = R::dispense('project');
                $this->project->name = $name;
                $this->project->date = time();
        }

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->project->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->project->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->project->name;
    }

    /**
     * @param mixed $block
     */
    public function setBlock($block)
    {
        $this->project->ownProjectList[] = $block;
    }

    /**
     * @return mixed
     */
    public function getBlock()
    {
        return $this->project->ownProjectList;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getProject()
    {
        return $this->project;
    }
}