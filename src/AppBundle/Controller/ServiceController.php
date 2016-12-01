<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ServiceController extends Controller
{
    public function profileCheck()
    {
        $auth_checker = $this->get('security.authorization_checker');
        $token = $this->get('security.token_storage')->getToken();

        $userId = $token->getUser();
        $user = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:User');

        $user->find($userId);

        $em = $this->getDoctrine()->getManager();

        $profile = $em->getRepository('AppBundle:UserProfile')
            ->findOneBy(['user' => $userId]);

        return $profile;
    }
}
