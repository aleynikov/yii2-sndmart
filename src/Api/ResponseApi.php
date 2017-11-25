<?php
namespace aleynikov\sndmart\Api;

class ResponseApi
{
    private $_data;

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function getData()
    {
        return $this->_data;
    }
}