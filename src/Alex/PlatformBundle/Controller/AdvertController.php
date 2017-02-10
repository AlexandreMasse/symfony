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

        return $this->render('@AlexPlatform/Advert/index.html.twig');

    }



    public function viewAction($id)
    {
        return $this->render('AlexPlatformBundle:Advert:view.html.twig', [
            'id' => $id
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

        return $this->render('AlexPlatformBundle:Advert:edit.html.twig');
    }


    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('AlexPlatformBundle:Advert:delete.html.twig');
    }

}