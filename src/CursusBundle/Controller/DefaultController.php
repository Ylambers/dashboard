<?php

namespace CursusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    public function indexAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Item');
        $profile = $repository->findAll();

        return $this->render('CursusBundle:Default:index.html.twig', [
            'data' => $profile
        ]);
    }
}
