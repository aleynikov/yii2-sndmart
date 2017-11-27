<?php
namespace aleynikov\sndmart\Api;

use aleynikov\sndmart\Entity\MessageEntity;
use aleynikov\sndmart\Exception\InvalidResponseException;
use yii\httpclient\Client;

class ClientApi extends ClientAbstract
{
    /**
     * @var string
     */
    protected $baseUrl = 'https://api.sndmart.com/';

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

        if (!$response->isOk) {
            throw new InvalidResponseException('Incorrect service response');
        }

        return new ResponseApi($response->getData());
    }

    /**
     * @param MessageEntity $message
     * @return mixed
     */
    public function sendNewMessage(MessageEntity $message)
    {
        return $this->_sendRequest('send', [
            'message' => $message->toArray(),
        ]);
    }
}
