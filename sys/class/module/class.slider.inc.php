<?php

/**
 * Class Slider
 */
class Slider extends DB_Connect
{
    private $id;

    private $slider;

    private $imageIds;

    private $params;

    public function __construct($dbo = NULL, $method = 'default', $id = null, $imageIds = null, $params = null)
    {
        parent::__construct($dbo);

        $this->initParams();

        switch ( $method ) {
            case 'load' :
                $this->slider = R::load('slider', $id);
                if( isset($imageIds) && !empty($imageIds) ) {
                    $this->slider->imageIds = $imageIds;
                }
                break;

            default :
                $this->slider = R::dispense('slider');
                $this->slider->date = time();
                $this->slider->imageIds = $imageIds;
                foreach ($this->params as $name => $value) {
                    $this->slider->$name = $value;
                }
                if( isset($params) && !empty($params) ) {
                    foreach ( $params as $name => $value ) {
                        $this->slider->$name = $value;
                     }
                }

        }
    }


    public function initParams() {
        $this->params = array(
            'numberOfItems' => 1,
            'margin'        => 0,
            'center' => false,
            'autoWidth' => false,
            'loop' => true,
            'autoplay' => true,
            'autoplayHoverPause' => true,
            'sliderSpeed' => 5000,
            'sliderSpeedAnimation' => 600,
            'animateInClass' => false,
            'animateOutClass' => false,
            'navigation' => false,
            'pagination' => false
        );
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->slider->id;
    }

    /**
     * @return mixed
     */
    public function getimageIds()
    {
        return $this->slider->imageIds;
    }

    /**
     * @param mixed $imageIds
     */
    public function setimageIds($imageIds)
    {
        $this->slider->imageIds = $imageIds;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getSlider()
    {
        return $this->slider;
    }
}