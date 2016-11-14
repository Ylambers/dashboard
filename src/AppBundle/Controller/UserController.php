<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
//    /**
//     * @Route("/user/fos/createUser", name="createUser")
//     */
//    public function createUserAction()
//    {
//        $user = new User();
//        $user->setEmail("adminl@gmail.com") ;
//        $user->setUsername("mitke") ;
//        $user->setPlainPassword("123123123") ;
//        $user->setEnabled(true) ;
//        $user->setSuperAdmin(true) ;
//
//
//        $this->get('fos_user.user_manager')->updateUser($user, false);
//
//
//        $this->getDoctrine()->getManager()->flush();
//
//        return new Response('fixed');
//
//    }

    /**
     * @Route("user/fos/show", name="showUser")
     */
    public function showUsersAction()
    {
        $user = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:User')
            ->findAll();

        return $this->render('admin/user/show.html.twig',[
            'user' => $user
        ]);
    }

    /**
     * @Route("user/fos/edit/{id}", name="editUser")
     */
    public function editUserAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        if (!$user){
            return $this->redirect('/user/fos/show');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect('/user/fos/show');
        }
        return $this->render('admin/user/edit.html.twig',[
            'user' => $user,
            'form' => $form->createView()
        ]);
    }


    /**
     *@Route("/user/fos/create", name="Createuser")
     *
     */
    public function createUserAction()
    {
        $user = new User();


    }
}
