<?php
namespace aleynikov\sndmart\Entity;

class TriggeredEmailEntity implements EntityInterface
{
    /**
     * @var
     */
    private $emailListId;

    /**
     * @var
     */
    private $contact;

    /**
     * @var
     */
    private $templateId;

    /**
     * @var
     */
    private $tags = [];

    /**
     * @var array
     */
    private $variables = [];

    /**
     * @param $emailListId
     * @return $this
     */
    public function setEmailListId($emailListId)
    {
        $this->emailListId = $emailListId;

        return $this;
    }

    /**
     * @param $contact
     * @return $this
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @param $templateId
     * @return $this
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setTags($name, $value)
    {
        $this->tags[] = compact('name', 'value');

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
    public function toArray() {
        return [
            'emailListId' => $this->emailListId,
            'contact'     => $this->contact,
            'templateId'  => $this->templateId,
            'tags'        => $this->tags,
            'variables'   => $this->variables,
        ];
    }
}