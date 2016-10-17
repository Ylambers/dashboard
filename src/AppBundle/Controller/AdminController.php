<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Electra;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/user", name="admin")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        return $this->render('admin/content.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/user/electra", name="electra")
     */
    public function createElectraAction(Request $request)
    {
        $electra = new Electra();

        $form = $this->createFormBuilder($electra)
            ->add('title', TextType::class)
            ->add('shortText', TextType::class)
            ->add('text', TextType::class)
            ->add('link', TextType::class)
            ->add('active', CheckboxType::class)
            ->add('imageId', TextType::class)
            ->add('Submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
        }

        $data = $this->getDoctrine()
            ->getRepository('AppBundle:Electra')
            ->findAll();


        return $this->render('admin/electra.html.twig',[
            'form' => $form->createView(),
            'data' => $data
        ]);
    }

    public function editElectraAction()
    {
        
    }

}
