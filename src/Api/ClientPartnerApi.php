<?php
namespace aleynikov\sndmart\Api;

use aleynikov\sndmart\Entity\ContactEntity;
use aleynikov\sndmart\Entity\TriggeredEmailEntity;
use aleynikov\sndmart\Exception\InvalidResponseException;
use yii\httpclient\Client;

class ClientPartnerApi extends ClientAbstract
{
    /**
     * @var string
     */
    protected $baseUrl = 'https://partner.sndmart.com/api';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * ClientPartnerApi constructor.
     * @param $accessToken
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;

        parent::__construct();
    }

    /**
     * @param $endpoint
     * @param array $data
     * @return ResponsePartnerApi
     */
    public function sendRequest($endpoint, array $data)
    {
        $request = $this->client->createRequest()
            ->setMethod('post')
            ->setUrl($endpoint)
            ->setFormat(Client::FORMAT_JSON)
            ->setOptions([
                'timeout' => 5,
            ])
            ->addHeaders([
                'content-type' => 'application/json',
                'access-token' => $this->accessToken,
            ])
            ->setData($data);

        $response = $request->send();
        return new ResponsePartnerApi($response->getData());
    }


}