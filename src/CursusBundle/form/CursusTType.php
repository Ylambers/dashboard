<?php

/**
 * Created by PhpStorm.
 * User: yaronlambers
 * Date: 01/12/2016
 * Time: 14:18
 */

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CursusTType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('beschrijving', TextType::class)
            ->add('prijs', IntegerType::class)
            ->add('boten', IntegerType::class)
            ->add('Submit', SubmitType::class)
            ->getForm();
    }
}