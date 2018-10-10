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

        if( isset($id) && !empty($id) ) {
            if ( !isset($_SESSION['user_id']) && empty($_SESSION['user_id']) ) {
                $this->id = $id;
                session_start();
                $_SESSION['user_id'] = $id;
            }
        }

        switch ( $method ) {
            case 'findAll' :
                $this->user = R::findAll('user');
                $this->save = false;
                break;

            case 'findById' :
                $this->user = R::find('user', 'id = ?', array($id));
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
    public function getId()
    {
        if( isset($this->user->id) && !empty($this->user->id) ) {
            return $this->user->id;
        }
        return $this->user->id;
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
        $this->user->xownProjectList[] = $project;
    }

    public function getProject()
    {
        return $this->user->xownProjectList;
    }

    public function __destruct()
    {
        if ($this->save) {
            R::store($this->user);
        }
    }
}