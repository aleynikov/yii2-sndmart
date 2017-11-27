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
     * @param mixed $emailListId
     */
    public function setEmailListId($emailListId)
    {
        $this->emailListId = $emailListId;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * @param mixed $templateId
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
    }

    public function setTags($name, $value)
    {
        $this->tags[] = compact('name', 'value');
    }

    /**
     * @param $name
     * @param $value
     */
    public function setVariable($name, $value)
    {
        $this->variables[] = compact('name', 'value');
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