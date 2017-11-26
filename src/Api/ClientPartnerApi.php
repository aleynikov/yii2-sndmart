<?php
namespace aleynikov\sndmart\Api;

use yii\httpclient\Client;
use aleynikov\sndmart\Exception\InvalidResponseException;

class ClientPartnerApi
{
    /**
     *
     */
    const API_URL = 'https://partner.sndmart.com/api/';

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var Client
     */
    private $client;

    /**
     * ClientPartnerApi constructor.
     * @param $accessToken
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
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
            ->addHeaders([
                'content-type' => 'application/json',
                'access-token' => $this->accessToken,
            ])
            ->setData($data);

        $response = $request->send();

        if (!$response->isOk) {
            throw new InvalidResponseException('Incorrect service response');
        }

        return new ResponseApi($response->getData());
    }

    /**
     * @param Contact $contact
     * @param $emailListId
     * @return mixed
     */
    public function addNewContact(Contact $contact, $emailListId)
    {
        return $this->_sendRequest('rest/email-list/contacts/add', [
            'emailListId' => $emailListId,
            'contacts'    => [$contact],
        ]);
    }
}