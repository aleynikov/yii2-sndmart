<?php
namespace aleynikov\sndmart\Api;

/**
 * Class ResponsePartnerApi
 * @package aleynikov\sndmart\Api
 */
class ResponsePartnerApi extends ResponseAbstract
{
    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->_data['result'] == 'true';
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->_data['error_stack'];
    }
}