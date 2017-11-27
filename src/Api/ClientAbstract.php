<?php
namespace aleynikov\sndmart\Api;

use yii\httpclient\Client;

abstract class ClientAbstract
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var Client
     */
    protected $client;

    /**
     * ClientAbstract constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'baseUrl'   => $this->baseUrl,
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