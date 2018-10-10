<?php


class Ip extends DB_Connect
{
    private $id;

    private $ip;

    public function __construct(
        $dbo = NULL,
        $method = 'default',
        $id = null,
        $ip = null
    )
    {
        parent::__construct($dbo);

        switch ( $method ) {
            case 'findOne' :
                $this->ip = R::findOne(
                    'ip','quiz_id = ?', [$id ]
                );
                break;
            case 'load' :
                $this->ip = R::load('ip', $id);
                if( isset($ip) && !empty($ip) ) {
                    $this->ip->ip = $ip;
                }
                break;
            default :
                $this->ip = R::dispense('ip');
                $this->ip->date = time();
                $this->ip->ip = $ip;

        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->ip->id;
    }

    /**
     * @return array|\RedBeanPHP\OODBBean
     */
    public function getIp()
    {
        return $this->ip;
    }
}