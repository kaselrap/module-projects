<?php

/**
 * Class User
 */
class User extends DB_Connect
{
    private $id;

    private $name;

    private $user;

    private $save = true;

    /**
     * User constructor.
     * @param null $dbo
     * @param string $method
     * @param null $id
     * @param null $name
     */
    public function __construct($dbo = NULL, $method = 'default', $id = null, $name = null)
    {
        /**
         * Call the parent constructor to check for
         * a database object
         */
        parent::__construct($dbo);

        switch ( $method ) {
            case 'findAll' :
                $this->user = R::findAll('user');
                $this->save = false;
                break;

            case 'load' :
                $this->user = R::load('user', $id);
                if( isset( $name ) && !empty($name) ) {
                    $this->user->name = $name;
                }
                break;

            default :
                $this->user = R::dispense('user');
                $this->user->name = $name;

        }

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->user->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->user->name = $name;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $project
     */
    public function setProject($project)
    {
        $this->user->ownUserList[] = $project;
    }

    public function getProject()
    {
        return $this->user->ownUserList;
    }

    public function __destruct()
    {
        if ($this->save) {
            R::store($this->user);
        }
    }
}