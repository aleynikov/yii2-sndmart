<?php
namespace aleynikov\sndmart;

use aleynikov\sndmart\Api\ClientApi;
use aleynikov\sndmart\Api\ClientPartnerApi;
use aleynikov\sndmart\Api\ResponseApi;
use aleynikov\sndmart\Api\ResponsePartnerApi;
use aleynikov\sndmart\Entity\ContactEntity;
use aleynikov\sndmart\Entity\EntityFactory;
use aleynikov\sndmart\Entity\MessageEntity;
use aleynikov\sndmart\Entity\TriggeredEmailEntity;
use \yii\base\Component;

/**
 * Class SmartSender
 * @package aleynikov\sndmart
 *
 */
class SmartSender extends Component
{
    /**
     * @var ClientApi
     */
    private $clientApi;

    /**
     * @var ClientPartnerApi
     */
    private $clientPartnerApi;

    /**
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $secret;

    /**
     * SmartSender constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function init()
    {
        $this->clientApi        = new ClientApi($this->key, $this->secret);
        $this->clientPartnerApi = new ClientPartnerApi($this->secret);

        parent::init();
    }

    /**
     * @param $name
     * @return Entity\ContactEntity|Entity\MessageEntity|Entity\TriggeredEmailEntity
     */
    public function createEntity($name)
    {
        return EntityFactory::create($name);
    }

    /**
     * @return Entity\MessageEntity
     */
    public function createMessageEntity()
    {
        return $this->createEntity('message');
    }

    /**
     * @return Entity\ContactEntity
     */
    public function createContactEntity()
    {
        return $this->createEntity('contact');
    }

    /**
     * @return Entity\TriggeredEmailEntity
     */
    public function createTriggeredEmailEntity()
    {
        return $this->createEntity('triggeredEmail');
    }

    /**
     * @param MessageEntity $message
     * @return ResponseApi
     */
    public function sendNewMessage(MessageEntity $message)
    {
        return $this->clientApi->sendRequest('send', [
            'message' => $message->toArray(),
        ]);
    }

    /**
     * @param ContactEntity $contact
     * @param $emailListId
     * @return ResponsePartnerApi
     */
    public function addNewContact(ContactEntity $contact, $emailListId)
    {
        return $this->clientPartnerApi->sendRequest('rest/email-list/contacts/add', [
            'emailListId' => $emailListId,
            'contacts'    => [$contact->toArray()],
        ]);
    }

    /**
     * @param ContactEntity $contact
     * @param $emailListId
     * @return ResponsePartnerApi
     */
    public function removeContact(ContactEntity $contact, $emailListId)
    {
        return $this->clientPartnerApi->sendRequest('rest/email-list/contacts/remove', [
            'emailListId' => $emailListId,
            'emails'      => [$contact->toArray()['email']],
        ]);
    }

    /**
     * @param TriggeredEmailEntity $triggeredEmail
     * @return ResponsePartnerApi
     */
    public function sendTriggeredEmail(TriggeredEmailEntity $triggeredEmail)
    {
        return $this->clientPartnerApi->sendRequest('api/rest/mailer/send', $triggeredEmail->toArray());
    }
}