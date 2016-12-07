<?php
/**
 * Created by PhpStorm.
 * User: ylamb
 * Date: 7-12-2016
 * Time: 19:04
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SchipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('averij', ChoiceType::class, [
                    'choices' => ['Ja' => '1'],
                    'expanded' => true,
                    'multiple' => true,
                ]
            )
            ->add('capaciteit', IntegerType::class)
            ->add('Submit', SubmitType::class)
            ->getForm();
    }
}