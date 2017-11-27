<?php
namespace aleynikov\sndmart\Api;

use yii\httpclient\Client;

abstract class ClientAbstract extends Client
{
    /**
     * ClientAbstract constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config + [
            'transport' => 'yii\httpclient\CurlTransport',
        ]);
    }

    /**
     * @param $endpoint
     * @param array $data
     * @return mixed
     */
    abstract public function sendRequest($endpoint, array $data);
}