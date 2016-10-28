<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Item;
use AppBundle\Form\ItemType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{

    /**
     * @Route("/user/item", name="item")
     */
    public function createItemAction(Request $request)
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect('/user/item');
        }

        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Item')
            ->findAll();

        return $this->render('admin/item/item.html.twig', [
            'data' => $data,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/item/edit/{id}")
     */
    public function editItemAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('AppBundle:Item')->find($id);

        if (!$item){
            return $this->redirect('/user/item');
        }

        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect('/user/item');
        }

        return $this->render('admin/item/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/item/delete/{id}", name="delete_item")
     */
    public function deleteImageAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Item');

        $image = $repository->findOneBy(['id' => $id]);
        $em->remove($image);
        $em->flush();

        return $this->redirect('/user/item');
    }
}
