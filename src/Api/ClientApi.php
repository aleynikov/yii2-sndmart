<?php
namespace aleynikov\sndmart\Api;

class ClientApi extends ClientAbstract
{
    /**
     * @var string
     */
    public $baseUrl = 'https://api.sndmart.com';

    /**
     * @var
     */
    private $key;

    /**
     * @var
     */
    private $secret;

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
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
            ->setFormat(self::FORMAT_JSON)
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
