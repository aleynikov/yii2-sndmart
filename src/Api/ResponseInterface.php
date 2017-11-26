<?php
namespace aleynikov\sndmart\Api;

/**
 * Interface ResponseInterface
 * @package aleynikov\sndmart\Api
 */
interface ResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccess();

    /**
     * @return mixed
     */
    public function getError();

    /**
     * @return array
     */
    public function getData();
}