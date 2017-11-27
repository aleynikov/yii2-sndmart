<?php
namespace aleynikov\sndmart;

use aleynikov\sndmart\Api\ClientApi;
use aleynikov\sndmart\Api\ClientPartnerApi;
use aleynikov\sndmart\Api\ResponseApi;
use aleynikov\sndmart\Api\ResponsePartnerApi;
use aleynikov\sndmart\Entity\EntityFactory;
use aleynikov\sndmart\Exception\MethodNotAllowedException;
use \yii\base\Component;

/**
 * Class SmartSender
 * @package aleynikov\sndmart
 *
 * @method ResponseApi sendNewMessage() sendNewMessage(MessageEntity $message)
 * @method ResponsePartnerApi addNewContact() addNewContact(ContactEntity $contact, $emailListId)
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
     * @param string $name
     * @param array $params
     * @return mixed
     * @throws MethodNotAllowedException
     */
    public function __call($name, $params)
    {
        if (method_exists($this->clientApi, $name)) {
            return call_user_func_array(
                [$this->clientApi, $name],
                $params
            );
        }

        if (method_exists($this->clientPartnerApi, $name)) {
            return call_user_func_array(
                [$this->clientPartnerApi, $name],
                $params
            );
        }

        throw new MethodNotAllowedException('Method not found.');
    }
}