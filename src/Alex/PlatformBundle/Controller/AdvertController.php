<?php

namespace Alex\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    public function indexAction()
    {
        //générer une url
       $url = $this->generateUrl('alex_platform_view',array('id' => 5));

       $content = $this->get('templating')->render('AlexPlatformBundle:Advert:index.html.twig', [
            'nom' => 'alex',
            'url' => $url
       ]);

       return new Response($content);

    }


    public function viewAction($id) {
        return new Response("L'id est : " . $id);
    }

}
