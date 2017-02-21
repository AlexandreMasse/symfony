<?php

namespace Alex\PlatformBundle\Antispam;

class AlexAntispam
{
    /*retourne true si le texte a moins de 50 caractères, false sinon */
    public function isSpam($text)
    {
        return strlen($text) < 50;
    }
}
















/*
private $mailer;
private $locale;
private $minlength;

public function __construct(\Swift_Mailer $mailer, $locale, $minlength)
{
    $this->mailer       = $mailer;
    $this->locale       = $locale;
    $this->minlength    = (int) $minlength;
}*/

