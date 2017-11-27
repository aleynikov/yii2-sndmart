<?php
namespace aleynikov\sndmart\Api;

/**
 * Class ResponsePartnerApi
 * @package aleynikov\sndmart\Api
 */
class ResponsePartnerApi extends ResponseAbstract
{
    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->_data['error_stack'];
    }
}