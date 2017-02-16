<?php

namespace Alex\PlatformBundle\Antispam;

class AlexAntispam
{
    private $mailer;
    private $locale;
    private $minlength;

    public function __construct(\Swift_Mailer $mailer, $locale, $minlength)
    {
        $this->mailer       = $mailer;
        $this->locale       = $locale;
        $this->minlength    = (int) $minlength;
    }


    public function isSpam($text)
    {

        return strlen($text) < $this->minlength;
    }
}