<?php
namespace aleynikov\sndmart;

use \yii\base\Component;

/**
 * Class SmartSender
 * @package aleynikov\sndmart
 *
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
     * @return Message
     */
    public static function createMessageInstance()
    {
        return new Message();
    }

    /**
     * @return TriggeredEmail
     */
    public static function createTriggeredEmailInstance()
    {
        return new TriggeredEmail();
    }

    /**
     * @return Contact
     */
    public static function createContactInstance()
    {
        return new Contact();
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

        throw new MethodNotAllowedException('Invalid call method');
    }
}