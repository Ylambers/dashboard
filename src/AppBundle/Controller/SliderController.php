<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Slider;
use AppBundle\Form\SliderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SliderController extends Controller
{
    /**
     * @Route("/user/slider", name="slider")
     */
    public function AddSliderAction(Request $request)
    {
        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Slider')
            ->findAll();

        $item = new Slider();
        $form = $this->createForm(SliderType::class, $item);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect('/user/slider');
        }

        return $this->render('admin/slider/view.html.twig', [
            'form' => $form->createView(),
            'data' => $data
        ]);
    }

    /**
     * @Route("/user/slider/edit/{id}", name="sliderEdit")
     */
    public function EditSliderAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('AppBundle:Slider')->find($id);

        if (!$item){
            return $this->redirect('/user/slider');
        }

        $form = $this->createForm(SliderType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect('/user/slider');
        }

        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Slider')
            ->findAll();

        return $this->render('admin/slider/edit.html.twig', [
            'data' => $data,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/slider/delete/{id}", name="delete_slider")
     */
    public function deleteImageAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Slider');

        $image = $repository->findOneBy(['id' => $id]);
        $em->remove($image);
        $em->flush();

        return $this->redirect('/user/slider');
    }
}
