<?php
/**
 * Created by PhpStorm.
 * User: ylamb
 * Date: 7-12-2016
 * Time: 18:29
 */

namespace AppBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CursusTypeextends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('startData', DateType::HTML5_FORMAT)
            ->add('Submit', SubmitType::class)
            ->getForm();
    }
}