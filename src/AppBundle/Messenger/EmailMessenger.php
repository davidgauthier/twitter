<?php

namespace AppBundle\Messenger;

use AppBundle\Entity\Tweet;

class EmailMessenger
{
    private $mailer;
    private $emailAdmin;

    public function __construct(\Swift_Mailer $mailer, $emailAdmin)
    {
        $this->mailer = $mailer;
        $this->emailAdmin = $emailAdmin;
    }

    public function sendTweetCreated(Tweet $tweet)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Super subject')
            ->setFrom($this->emailAdmin)
            ->setTo('send.to@mail.net')
            ->setBody('Hello FAG :)');

        $this->send($message);
    }


    public function send(\Swift_Message $message){
        $this->mailer->send($message);
    }
}
