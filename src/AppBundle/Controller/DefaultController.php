<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $electra = $this->getDoctrine()
            ->getRepository('AppBundle:Electra')
            ->findBy([
                'active' => 1
            ]);


        return $this->render('default/index.html.twig', [
            'electra' => $electra
        ]);
    }
}
