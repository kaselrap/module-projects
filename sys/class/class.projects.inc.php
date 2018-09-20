<?php

/**
 * Class Projects
 */
class Projects extends DB_Connect
{
    private $id;

    private $name;

    private $date;

    private $project;

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
                $this->project = R::load('projects', $id);
                break;

            default :
                $this->project = R::dispense('projects');
                $this->project->date = time();
        }

    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
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

    public function __destruct()
    {
        $this->id = R::store($this->project);
    }
}