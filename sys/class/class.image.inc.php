<?php

/**
 * Class Image
 */
class Image extends DB_Connect
{

    private $id;

    private $src;

    private $alt;

    private $image;

    private $save = true;

    /**
     * Image constructor.
     * @param null $dbo
     * @param string $method
     * @param null $id
     * @param null $src
     * @param null $alt
     */
    public function __construct(
        $dbo = NULL,
        $method = '',
        $id = null,
        $src = null,
        $alt = null,
        $order = null,
        $limit = null
    )
    {
        /**
         * Call the parent constructor to check for
         * a database object
         */
        parent::__construct($dbo);

        switch ( $method ) {
            case 'findByIds' :
                $this->image = R::find('image', 'id IN ( '. R::genSlots( $id ) .' ) ',
                    $id);
                $this->save = false;
                break;

            case 'find' :
                if ( $order && $limit) {
                    $this->image = R::findAll('image', 'ORDER BY id DESC LIMIT ' . $limit);
                } else if ($order) {
                    $this->image = R::findAll('image', 'ORDER BY id DESC');
                } else if ($limit) {
                    $this->image = R::findAll('image', 'LIMIT ' . $limit);
                } else {
                    $this->image = R::findAll('image');
                }
                $this->save = false;
                break;
            case 'findAll' :
                if ( $order ) {
                    $this->image = R::findAll('image', 'ORDER BY id DESC');
                } else {
                    $this->image = R::findAll('image');
                }
                $this->save = false;
                break;
            case 'load' :
                $this->image = R::load('image', $id);
                if( isset( $src ) && !empty($src) ) {
                    $this->image->src = $src;
                }
                if( isset( $alt ) && !empty($alt) ) {
                    $this->image->src = $alt;
                }
                break;

            default :
                $this->image = R::dispense('image');
                $this->image->date = time();
                if ( is_array($src) ) {
                    $this->image->src = $src['main'];
                    $this->image->srcPreview = $src['preview'];
                } else {
                    $this->image->src = $src;
                }
                $this->image->alt = $alt;

        }

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->image->id;
    }

    /**
     * @return mixed
     */
    public function getAlt()
    {
        return $this->image->alt;
    }

    /**
     * @param mixed $alt
     */
    public function setAlt($alt)
    {
        $this->image->alt = $alt;
    }

    /**
     * @return mixed
     */
    public function getSrc()
    {
        return $this->image->src;
    }

    /**
     * @param mixed $src
     */
    public function setSrc($src)
    {
        $this->image->src = $src;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getImage()
    {
        return $this->image;
    }

    public function save()
    {
        if ($this->save) {
            $this->image->id = R::store($this->image);
        }
    }


}