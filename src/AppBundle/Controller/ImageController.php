<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use AppBundle\Form\ImageType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function addImageAction(Request $request)
    {
        $image = new Image();


        $form = $this->createForm(ImageType::class, $image);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){
            $file = $image->getImage();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),
                $fileName
            );

            $image->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect('/user/image/show');
        }

        return $this->render('admin/image/upload.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    public function showImageAction()
    {
        $data = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Image')
            ->findAll();

        return $this->render('admin/image/show.html.twig',[
            'data' => $data
        ]);
    }

    public function deleteImageAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Image');
        $image = $repository->findOneBy(['id' => $id]);
        $em->remove($image);
        $em->flush();

        return $this->redirect('/user/image/show');
    }


    public function editImageAction($id, Request $request)
    {
        //TODO fix edit page

        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('AppBundle:Image')->find($id);

        if (!$image){
            return $this->redirect('/user/image');
        }

        $form = $this->createFormBuilder($image)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
//            ->add('image', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirect('/user/image');
        }

        return $this->render('admin/image/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
