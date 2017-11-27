<?php
namespace aleynikov\sndmart\Entity;

/**
 * Class EntityFactory
 * @package aleynikov\sndmart\Entity
 */
class EntityFactory
{
    /**
     * @param $name
     * @return ContactEntity|MessageEntity|TriggeredEmailEntity
     */
    public static function create($name)
    {
        switch($name) {
            case 'message':
                return new MessageEntity();
            case 'contact':
                return new ContactEntity();
            case 'triggeredEmail':
                return new TriggeredEmailEntity();
        }
    }
}