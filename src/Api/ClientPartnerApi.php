<?php
namespace aleynikov\sndmart\Api;

use aleynikov\sndmart\Entity\ContactEntity;
use aleynikov\sndmart\Exception\InvalidResponseException;
use yii\httpclient\Client;

class ClientPartnerApi extends ClientAbstract
{
    /**
     * @var string
     */
    protected $baseUrl = 'https://partner.sndmart.com/api/';

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

        return new ResponsePartnerApi($response->getData());
    }

    /**
     * @param ContactEntity $contact
     * @param $emailListId
     * @return mixed
     */
    public function addNewContact(ContactEntity $contact, $emailListId)
    {
        return $this->_sendRequest('rest/email-list/contacts/add', [
            'emailListId' => $emailListId,
            'contacts'    => [$contact],
        ]);
    }
}