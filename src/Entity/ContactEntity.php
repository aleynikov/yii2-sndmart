<?php
namespace aleynikov\sndmart\Entity;

class ContactEntity implements EntityInterface
{
    /**
     * @var
     */
    private $email;

    /**
     * @var
     */
    private $name;

    /**
     * @var bool
     */
    private $active = true;

    /**
     * @var array
     */
    private $variables = [];

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setVariable($name, $value)
    {
        $this->variables[] = compact('name', 'value');

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'email'     => $this->email,
            'name'      => $this->name,
            'active'    => $this->active,
            'variables' => $this->variables,
        ];
    }
}