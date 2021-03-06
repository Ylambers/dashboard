<?php
/**
 * Created by PhpStorm.
 * User: ylamb
 * Date: 7-12-2016
 * Time: 18:29
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CursusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cursusType', EntityType::class, array(
                'class' => 'AppBundle:CursusType',
                'choice_label' => function ($type) {
                    return $type->getTitle();
                }))
            ->add('naam', TextType::class)
            ->add('beschrijving', TextType::class)
            ->add('personen', IntegerType::class)
            ->add('datum', DateType::class, array(
                'widget' => 'choice',
                'years' => range(2016, 2020 ),
                'months' => range(1,12),
                'days' => range(1, 31)
            ))
            ->add('Submit', SubmitType::class)
            ->getForm();
    }
}