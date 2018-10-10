<?php

class Video extends DB_Connect
{

    private $id;

    private $video;

    private $iframe;

    public function __construct($dbo = NULL, $method = 'default', $id = null, $iframe = null)
    {
        parent::__construct($dbo);

        switch ( $method ) {
            case 'findOne' :
                $this->video = R::findOne(
                    'video','module_id = ?', [$id ]
                );

                break;
            case 'findByModuleId' :
                $this->video = R::findLike(
                    'video',
                    ['module_id' => [$id]],
                    'ORDER by `order` '
                );
                break;
            case 'load' :
                $this->video = R::load('video', $id);
                if( isset($iframe) && !empty($iframe) ) {
                    $this->video->iframe = $iframe;
                }
                break;

            default :
                $this->video = R::dispense('video');
                $this->video->date = time();
                $this->video->iframe = $iframe;

        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->video->id;
    }

    /**
     * @return mixed
     */
    public function getIframe()
    {
        return $this->video->iframe;
    }

    /**
     * @param mixed $iframe
     */
    public function setIframe($iframe)
    {
        $this->video->iframe = $iframe;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getVideo()
    {
        return $this->video;
    }
}