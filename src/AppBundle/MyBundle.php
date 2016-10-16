<?php
/**
 * Created by PhpStorm.
 * User: ylamb
 * Date: 14-10-2016
 * Time: 18:56
 */

namespace AppBundle;


use Symfony\Component\HttpKernel\Bundle\Bundle;

class MyBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}