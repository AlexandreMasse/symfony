<?php

namespace Alex\PlatformBundle\Controller;

use Alex\PlatformBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    //Fonction pour la page d'acceuil
    public function indexAction($page)
    {
        //Retoune une erreur si le numero de page dans l'URL est inférieur à 1
        if ($page < 1) {
            throw new NotFoundHttpException('La page "' . $page . '" est inexistante !');
        }

        // Notre liste d'annonce "en dur"
        $listAdverts = array(
            array(
                'title'   => 'Recherche développpeur Symfony',
                'id'      => 1,
                'author'  => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon...',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Mission de webmaster',
                'id'      => 2,
                'author'  => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet...',
                'date'    => new \Datetime()),
            array(
                'title'   => 'Offre de stage webdesigner',
                'id'      => 3,
                'author'  => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner...',
                'date'    => new \Datetime())
        );


        return $this->render('AlexPlatformBundle:Advert:index.html.twig', [
            'listAdverts' => $listAdverts
        ]);

    }


    //Fonction pour l'affichage de la page d'une annonce
    public function viewAction($id)
    {
        /*
        //annonce en dur
        $advert = array(
            'title'   => 'Recherche développpeur Symfony3',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony3 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime()
        );
        */

        // On récupère le repository
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('AlexPlatformBundle:Advert')
        ;

        // On récupère l'entité correspondante à l'id $id
        $advert = $repository->find($id);

        // $advert est donc une instance de Alex\PlatformBundle\Entity\Advert ou null si l'id $id  n'existe pas, d'où ce if :
        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        
        return $this->render('AlexPlatformBundle:Advert:view.html.twig', [
            'advert' => $advert
        ]);
    }


    public function addAction(Request $request)
    {
        // Création de l'entité
        $advert = new Advert();
        $advert->setTitle('Recherche développeur Symfony.');
        $advert->setAuthor('Alexandre');
        $advert->setContent("Nous recherchons un développeur Symfony expert en la matière sur Paris....");

        // On peut ne pas définir ni la date ni la publication, car ces attributs sont définis automatiquement dans le constructeur

        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getManager();

        // Étape 1 : On « persiste » l'entité
        $em->persist($advert);

        // Étape 2 : On « flush » tout ce qui a été persisté avant
        $em->flush();


        //verifie si la methode est POST
        if ($request->isMethod('POST')) {

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée');

            // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirectToRoute('alex_platform_view', [
                'id' => $advert->getId()
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