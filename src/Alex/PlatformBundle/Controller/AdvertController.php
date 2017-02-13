<?php

namespace Alex\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{


    public function indexAction($page)
    {

        if ($page < 1) {
            throw new NotFoundHttpException('La page "' . $page . '" est inexistante !');
        }


        // Notre liste d'annonce en dur
        $listAdverts = array(
            array(
                'title'   => 'Recherche développpeur Symfony',
                'id'      => 1,
                'author'  => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Mission de webmaster',
                'id'      => 2,
                'author'  => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 3,
                'author'  => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime())
        );


        return $this->render('AlexPlatformBundle:Advert:index.html.twig', [
            'listAdverts' => $listAdverts
        ]);

    }



    public function viewAction($id)
    {
        //annonce en dur
        $advert = array(
            'title'   => 'Recherche développpeur Symfony3',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony3 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );


        return $this->render('AlexPlatformBundle:Advert:view.html.twig', [
            'advert' => $advert
        ]);
    }


    public function addAction(Request $request)
    {
        //verifie si la methode est POST
        if ($request->isMethod('POST')) {

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée');

            return $this->redirectToRoute('alex_platform_view', [
                'id' => 5
            ]);
        }


        //Si la méthode n'est pas POST alors rediriger vers la page formulaire
        return $this->render('AlexPlatformBundle:Advert:add.html.twig');
    }



    public function editAction($id, Request $request)
    {
        if ($request->isMethod('POST')) {

            $request->getSession()->getFlashBag()->add('notice', 'Annonce à bien été modifiée');

            return $this->render('AlexPlatformBundle:Advert:view.html.twig', [
                'id' => $id
            ]);
        }

        $advert = array(
            'title'   => 'Recherche développpeur Symfony',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );

        return $this->render('AlexPlatformBundle:Advert:edit.html.twig', [
            'advert' => $advert
        ]);
    }



    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('AlexPlatformBundle:Advert:delete.html.twig');
    }



    public function menuAction($limit)
    {
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche developpeur Symfony'),
            array('id' => 5, 'title' => 'Offre de stage webdesigner'),
            array('id' => 9, 'title' => 'Recherche de graphiste')
        );

        return $this->render('AlexPlatformBundle:Advert:menu.html.twig', [
            'listAdverts' => $listAdverts
        ]);
    }
}