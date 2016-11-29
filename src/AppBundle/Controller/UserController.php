<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\UserProfile;
use AppBundle\Form\UserProfileType;
use AppBundle\Form\UserType;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{

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
        //TODO Fix change password
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
     * @Route("user/fos/register", name="registration")
     */
    public function registerUserAction()
    {
        return $this->render('admin/user/registrationUser.html.twig',[]);
    }

    /**
     *@Route("/user/fos/create", name="Createuser")
     *
     */
    public function createUserAction()
    {
        //TODO fix create user action
        $user = new User();


    }

    /**
     * @Route("user/profile", name="profile")
     */
    public function userProfileAction(Request $request)
    {
        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:User');

        $user->find($userId);

        $em = $this->getDoctrine()->getManager();

        $profile = $em->getRepository('AppBundle:UserProfile')
            ->findOneBy(['user' => $userId]);


        if (is_null($profile)) {
            $profile = new UserProfile();
            $profile->setUser($em->getRepository('AppBundle:User')->find($userId));
            $profile->setFirstName(null);
            $profile->setLastName(null);
            $profile->setDateOfBirth(null);
            $profile->setEmail(null);
            $profile->setPhoneNumber(null);
            $profile->setMobileNumber(null);
            $profile->setAddress(null);

            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();

            return $this->redirect('/user/profile');

        }else{
            $form = $this->createForm(UserProfileType::class, $profile);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $data = $form->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush();

                return $this->redirect('/user/profile');
            }
        }

        return $this->render('admin/user/profile.html.twig',[
            'form' => $form->createView()
        ]);

    }
}
