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
     * @return Entity
     */
    public static function create($name)
    {
        switch($name) {
            case 'message':
                return new Message();
            case 'constact':
                return new Contact();
            case 'triggeredEmail':
                return new TriggeredEmail();
        }
    }
}