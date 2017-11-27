<?php
namespace aleynikov\sndmart\Api;

class ClientPartnerApi extends ClientAbstract
{
    /**
     * @var string
     */
    public $baseUrl = 'https://partner.sndmart.com/api';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param $endpoint
     * @param array $data
     * @return ResponsePartnerApi
     */
    public function sendRequest($endpoint, array $data)
    {
        $request = $this->createRequest()
            ->setMethod('post')
            ->setUrl($endpoint)
            ->setFormat(self::FORMAT_JSON)
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