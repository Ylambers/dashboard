<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cursus;
use AppBundle\Entity\Schip;
use AppBundle\Form\CursusTType;
use AppBundle\Form\CursusType;
use AppBundle\Form\SchipType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CursussenController extends Controller
{
    public function cursusAction(Request $request)
    {
        $cat = new Cursus();

        $form = $this->createForm(CursusType::class, $cat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
        }

        return $this->render('admin/cursus/cursus.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function cursusTypeAction(Request $request)
    {
        $type = new \AppBundle\Entity\CursusType();

        $form = $this->createForm(CursusTType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect('/admin/cursus');
        }

        return $this->render('admin/cursus/cursusType.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function createSchipAction(Request $request)
    {
        $schip = new Schip();

        $form = $this->createForm(SchipType::class, $schip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect('/admin/cursus');
        }

        return $this->render('admin/cursus/schip.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
