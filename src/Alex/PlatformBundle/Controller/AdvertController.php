<?php

namespace Alex\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    public function indexAction()
    {

        $content = $this->get('templating')->render('AlexPlatformBundle:Advert:index.html.twig', [
            'nom' => 'alex'
        ]);

        return new Response($content);


    }

    //test pour savoir si j'ai bien compris
    public function testAction() {
        return $this->render('AlexPlatformBundle:Advert:test.html.twig');
    }
}
