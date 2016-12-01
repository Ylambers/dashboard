<?php

namespace CursusBundle\Controller;

use CursusBundle\Entity\Cursus;
use CursusBundle\Entity\CursusType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class CursussenController extends Controller
{
    public function cursusAction(Request $request)
    {
        $cat = new Cursus();
        $year = date("Y");
        $month = date("m");

        $form = $this->createFormBuilder($cat)
            ->add('cursusType', EntityType::class, array(
                'class' => 'CursusBundle:CursusType',
                'choice_label' => function ($type) {
                    return $type->getTitle();
                }))
            ->add('naam', TextType::class)
            ->add('beschrijving', TextType::class)
            ->add('personen', IntegerType::class)
            ->add('datum', DateType::class, array(
                'widget' => 'choice',
                'years' => range(2016, 2020 ),
                'months' => range(1,12),
                'days' => range(1, 31)
            ))
            ->add('Submit', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

             $em = $this->getDoctrine()->getManager();
             $em->persist($task);
             $em->flush();

            return $this->redirectToRoute('home');
        }


        return $this->render('admin/cursus/cursus.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function cursusTypeAction(Request $request)
    {

        $cat = new CursusType();
        $form = $this->createFormBuilder($cat)
            ->add('title', TextType::class)
            ->add('beschrijving', TextType::class)
            ->add('prijs', IntegerType::class)
            ->add('boten', IntegerType::class)
            ->add('Submit', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('home');
        }


        return $this->render('admin/cursus/cursusType.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function signUpAction()
    {
        
    }
}
