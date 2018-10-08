<?php

/**
 * Class Gallery
 * https://github.com/yairEO/photobox
 */
class Gallery extends DB_Connect
{

    private $id;

    private $gallery;

    private $imageIds;

    public function __construct($dbo = NULL, $method = 'default', $id = null, $imageIds = null)
    {
        parent::__construct($dbo);

        switch ( $method ) {
            case 'load' :
                $this->gallery = R::load('gallery', $id);
                if( isset($imageIds) && !empty($imageIds) ) {
                    $this->gallery->imageIds = $imageIds;
                }
                break;

            default :
                $this->gallery = R::dispense('gallery');
                $this->gallery->date = time();
                $this->gallery->imageIds = $imageIds;

        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->gallery->id;
    }

    /**
     * @return mixed
     */
    public function getImageIds()
    {
        return $this->gallery->imageIds;
    }

    /**
     * @param mixed $imageIds
     */
    public function setImageIds($imageIds)
    {
        $this->imageIds = $imageIds;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}