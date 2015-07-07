<?php

namespace AppBundle\Infrastructure\Mail;

class LazyMessage
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var string|array
     */
    private $sendTo;

    /**
     * @param string $sendTo
     * @param string $subject
     * @param string $template
     * @param mixed $data
     */
    public function __construct($sendTo, $subject, $template, $data = null)
    {
        $this->sendTo = $sendTo;
        $this->subject = $subject;
        $this->template = $template;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getSendTo()
    {
        return $this->sendTo;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
