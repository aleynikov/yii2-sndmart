<?php
namespace aleynikov\sndmart\Api;

/**
 * Class ResponseApi
 * @package aleynikov\sndmart\Api
 */
class ResponseApi extends ResponseAbstract
{
    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->_data['error'];
    }
}