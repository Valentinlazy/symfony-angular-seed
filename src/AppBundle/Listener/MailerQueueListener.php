<?php
namespace AppBundle\Listener;

use AppBundle\Infrastructure\Mail\Messenger;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;

class MailerQueueListener
{
    /**
     * @var  Messenger
     */
    protected $messenger;

    /**
     * @param $messenger
     */
    public function __construct(Messenger $messenger)
    {
        $this->messenger = $messenger;
    }

    /**
     * @param PostResponseEvent $event
     */
    public function onKernelTerminate(PostResponseEvent $event)
    {
        $this->messenger->flush();
    }
}
