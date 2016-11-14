<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class InstallController extends Controller
{

    public function createImageAction()
    {
        $image = new Image();

        $image->setName('No image');
        $image->setDescription('No image');
        $image->setImage('');


        $em = $this->getDoctrine()->getEntityManager();

        $em->persist($image);
        $em->flush();

        return new Response('succes');
    }
}
