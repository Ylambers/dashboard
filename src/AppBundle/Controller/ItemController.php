<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Item;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\ChoiceList\View\ChoiceListView;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ItemController extends Controller
{

    /**
     * @Route("/user/item", name="item")
     */
    public function createItemAction(Request $request)
    {
        $item = new Item();
        $form = $this->createFormBuilder($item)
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ))
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

        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Item')
            ->findAll();

        return $this->render('admin/item.html.twig', [
            'data' => $data,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/item/{id}")
     */
    public function editItemAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $new = $em->getRepository('AppBundle:Item')->findBy([
            'id' => $id
        ]);

        $form = $this->createFormBuilder($new)
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ))
            ->add('title', TextType::class)
            ->add('shortText', TextType::class)
            ->add('text', TextType::class)
            ->add('link', TextType::class)
            ->add('active', CheckboxType::class)
            ->add('imageId', TextType::class)
            ->add('Submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){
            $data = $form->getData();
            $em->persist($new);
            $em->flush();

            return new Route('/user');
        }

        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
