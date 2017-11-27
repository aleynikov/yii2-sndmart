<?php
namespace aleynikov\sndmart\Api;

/**
 * Class ResponseAbstract
 * @package aleynikov\sndmart\Api
 */
abstract class ResponseAbstract
{
    /**
     * @var mixed
     */
    protected $_data;

    /**
     * ResponseApi constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->_data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return !empty($this->_data)
            ? $this->_data
            : array();
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return (bool) $this->_data['result'];
    }

    /**
     * @return mixed
     */
    abstract public function getError();
}