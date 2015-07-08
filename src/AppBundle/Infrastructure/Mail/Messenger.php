<?php

namespace AppBundle\Infrastructure\Mail;

use CoreDomain\Model\Password;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;
use CoreDomain\Model\User;
use CoreDomain\Infrastructure\Mail\MessengerInterface;

class Messenger implements MessengerInterface
{
    /**
     * @var LazyMessage[]
     */
    public $pendingEmails;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var string
     */
    private $from;

    /**
     * @param \Swift_Mailer $mailer
     * @param EngineInterface $templating
     * @param TranslatorInterface $translator
     * @param string $from
     */
    public function __construct(
        \Swift_Mailer $mailer,
        EngineInterface $templating,
        TranslatorInterface $translator,
        $from
    ) {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->translator = $translator;
        $this->from = $from;

        $this->clear();
    }

    public function sendResettingEmailMessage(User $user, Password $password)
    {
        $this->send(
            [$user->getEmail() => $user->getFullName()],
            'resetting.email.subject',
            ':mail:user.resetting.html.twig',
            ['user' => $user, 'password' => $password->getPlainPassword()]
        );
    }

    /**
     * @param string $sendTo
     * @param string $subject
     * @param string $template
     * @param mixed $data
     */
    public function send($sendTo, $subject, $template, $data = null)
    {
        $this->pendingEmails[] = new LazyMessage($sendTo, $subject, $template, $data);
    }

    /**
     * Flushes messages
     */
    public function flush()
    {
        foreach ($this->pendingEmails as $email) {
            $message = \Swift_Message::newInstance()
                ->setSubject($this->translator->trans($email->getSubject()))
                ->setFrom($this->from)
                ->setTo($email->getSendTo())
                ->setBody($this->templating->render(
                    $email->getTemplate(),
                    $email->getData()
                ));

            $this->mailer->send($message, $failedRecipients);
        }

        $this->clear();
    }

    public function clear()
    {
        $this->pendingEmails = [];
    }
}
