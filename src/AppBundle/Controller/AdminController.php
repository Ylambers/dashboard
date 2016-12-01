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

class AdminController extends Controller
{

    public function indexAction()
    {

        $userId = $this->getUser()->getId();
        $user = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:User');

        $user->find($userId);

        $em = $this->getDoctrine()->getManager();

        $profile = $em->getRepository('AppBundle:UserProfile')
            ->findOneBy(['user' => $userId]);

        if (is_null($profile)) {
            return $this->redirect('/user/profile');
        }


        return $this->render('admin/content.html.twig', [
//            'user' => $user
        ]);
    }

}
