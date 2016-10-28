<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Item;
use AppBundle\Form\CategoryType;
use AppBundle\Form\ItemType;
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

        return $this->render('admin/category/category.html.twig', [
            'form' => $form->createView(),
            'data' => $data
        ]);
    }

    /**
     * @Route("/user/category/delete/{id}", name="delete_category")
     */
    public function deleteCategoryAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Category');

        $item = $repository->findOneBy(['id' => $id]);
        $em->remove($item);
        $em->flush();

        return $this->redirect('/user/category');
    }

    /**
     * @Route("/user/category/edit/{id}", name="edit_category")
     */
    public function editCategoryAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('AppBundle:Category')->find($id);

        if (!$item){
            return $this->redirect('/user/category');
        }

        $form = $this->createForm(CategoryType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect('/user/category');
        }

        return $this->render('admin/category/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
