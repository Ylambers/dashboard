<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
//        return $this->redirect('/login');
    }

    public function homeAction()
    {
//        $service = $this->forward('general_service:profileCheck');
////
//        var_dump($service());
//
//        if (is_null($service())) {
//            return $this->redirect('/user/profile');
//        }

        return $this->render('admin/content.html.twig');
    }

}
