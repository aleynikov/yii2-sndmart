<?php
namespace aleynikov\sndmart\Api;

use yii\httpclient\Client;

abstract class ClientAbstract extends Client
{
    abstract protected function _doRequest($uri, array $data);
}