<?php
namespace aleynikov\sndmart\Api;

use yii\httpclient\Client;

class ClientApi extends ClientAbstract
{
    /**
     * @var string
     */
    protected $baseUrl = 'https://api.sndmart.com';

    /**
     * @var
     */
    private $key;

    /**
     * @var
     */
    private $secret;

    /**
     * ClientApi constructor.
     * @param $key
     * @param $secret
     */
    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;

        parent::__construct();
    }

    /**
     * @param $endpoint
     * @param array $data
     * @return ResponseApi
     */
    public function sendRequest($endpoint, array $data)
    {
        $request = $this->client->createRequest()
            ->setMethod('post')
            ->setUrl($endpoint)
            ->setFormat(Client::FORMAT_JSON)
            ->addHeaders(['content-type' => 'application/json'])
            ->setOptions([
                'timeout' => 5,
            ])
            ->setData(array_merge([
                'key' => $this->key,
                'secret' => $this->secret,
            ], $data));

        $response = $request->send();
        return new ResponseApi($response->getData());
    }
}
