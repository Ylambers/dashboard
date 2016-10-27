<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Item;
use AppBundle\Form\CategoryType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\ChoiceList\View\ChoiceListView;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/user/category", name="category")
     */
    public function createCategoryAction(Request $request)
    {
        $cat = new Category();

        $form = $this->createForm(CategoryType::class, $cat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
        }

        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Category')
            ->findAll();

        return $this->render('admin/category.html.twig', [
            'form' => $form->createView(),
            'data' => $data
        ]);
    }
}
