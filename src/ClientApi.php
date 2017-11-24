<?php
namespace aleynikov\sndmart;

use yii\httpclient\Client;

class ClientApi
{
    /**
     *
     */
    const API_URL = 'https://api.sndmart.com/';

    /**
     * @var
     */
    private $key;

    /**
     * @var
     */
    private $secret;

    /**
     * @var
     */
    private $client;

    /**
     * ClientApi constructor.
     * @param $key
     * @param $secret
     */
    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->client = new Client([
            'baseUrl'   => self::API_URL,
            'transport' => 'yii\httpclient\CurlTransport',
        ]);
    }

    /**
     * @param $endpoint
     * @param array $data
     * @return mixed
     * @throws InvalidResponseException
     */
    protected function _sendRequest($endpoint, array $data)
    {
        $request = $this->client->createRequest()
            ->setMethod('post')
            ->setUrl($endpoint)
            ->setFormat(Client::FORMAT_JSON)
            ->addHeaders(['content-type' => 'application/json'])
            ->setData(array_merge([
                'key' => $this->key,
                'secret' => $this->secret,
            ], $data));

        $response = $request->send();

        if (!$response->isOk()) {
            throw new InvalidResponseException('Incorrect service response');
        }

        return $response->getData();
    }

    /**
     * @param Message $message
     * @return mixed
     */
    public function sendNewMessage(Message $message)
    {
        return $this->_sendRequest('send', [
            'message' => $message->toArray(),
        ]);
    }
}
