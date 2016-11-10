<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/user/fos/createUser", name="createUser")
     */
    public function createUserAction()
    {
        $user = new User();
        $user->setEmail("adminl@gmail.com") ;
        $user->setUsername("mitke") ;
        $user->setPlainPassword("123123123") ;
        $user->setEnabled(true) ;
        $user->setSuperAdmin(true) ;


        $this->get('fos_user.user_manager')->updateUser($user, false);


        $this->getDoctrine()->getManager()->flush();

        return new Response('fixed');

    }

    /**
     * @Route("user/fos/show", name="showUser")
     */
    public function showUsers()
    {
        $user = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:User')
            ->findAll();

        return $this->render('admin/user/show.html.twig',[
            'user' => $user
        ]);
    }
}
