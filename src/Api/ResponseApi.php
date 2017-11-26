<?php
namespace aleynikov\sndmart\Api;

/**
 * Class ResponseApi
 * @package aleynikov\sndmart\Api
 */
class ResponseApi extends ResponseAbstract
{
    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->_data['result'] == 1;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->_data['error'];
    }
}