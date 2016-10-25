<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TrafficController extends Controller
{
    public function getIp()
    {
        $userIp = $this->container->get('request_stack')->getMasterRequest()->getClientIp();

        return $userIp;
    }

    /**
     * @Route("/user/ip", name="ip")
     */
    public function addData(Request $request)
    {
        $userIp = $this->getIp();
        return $this->render('admin/traffic/ip.html.twig',[
            'ip' => $userIp
        ]);
    }
}
