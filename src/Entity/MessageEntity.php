<?php
namespace aleynikov\sndmart\Entity;

class MessageEntity implements EntityInterface
{
    /**
     * @var string
     */
    private $fromEmail;

    /**
     * @var string
     */
    private $fromName;

    /**
     * @var array
     */
    private $replyTo = [];

    /**
     * @var string
     */
    private $subject;

    /**
     * @var array
     */
    private $to = [];

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var array
     */
    private $tags = [];

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $html;

    /**
     * @param $fromEmail
     * @return $this
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    /**
     * @param $fromName
     * @return $this
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @param $email
     * @param string $name
     * @return $this
     */
    public function setReplyTo($email, $name = '')
    {
        $this->replyTo[] = compact('email', 'name');

        return $this;
    }

    /**
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @param $email
     * @param string $name
     * @return $this
     */
    public function setTo($email, $name = '')
    {
        $this->to[] = compact('email', 'name');

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setHeader($name, $value)
    {
        $this->headers[] = compact('name', 'value');

        return $this;
    }

    /**
     * @param $tag
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @param $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param $html
     * @return $this
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'from_email' => $this->fromEmail,
            'from_name'  => $this->fromName,
            'reply_to'   => $this->replyTo,
            'subject'    => $this->subject,
            'to'         => $this->to,
            'headers'    => $this->headers,
            'tags'       => $this->tags,
            'text'       => $this->text,
            'html'       => $this->html,
        ];
    }
}