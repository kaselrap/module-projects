<?php

/**
 * Class Logotype
 */
class Logotype extends DB_Connect
{
    private $id;

    private $logotype;

    private $imageId;

    public function __construct($dbo = NULL, $method = 'default', $id = null, $imageId = null)
    {
        parent::__construct($dbo);

        switch ( $method ) {
            case 'load' :
                $this->logotype = R::load('logotype', $id);
                if( isset($imageId) && !empty($imageId) ) {
                    $this->logotype->imageId = $imageId;
                }
                break;

            default :
                $this->logotype = R::dispense('logotype');
                $this->logotype->date = time();
                $this->logotype->imageId = $imageId;

        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->logotype->id;
    }

    /**
     * @return mixed
     */
    public function getImageId()
    {
        return $this->logotype->imageId;
    }

    /**
     * @param mixed $imageId
     */
    public function setImageId($imageId)
    {
        $this->logotype->imageId = $imageId;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getLogotype()
    {
        return $this->logotype;
    }
}