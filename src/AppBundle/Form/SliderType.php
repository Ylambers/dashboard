<?php
/**
 * Created by PhpStorm.
 * User: yaronlambers
 * Date: 07/11/2016
 * Time: 13:15
 */

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'required' => false
            ])
            ->add('smallDescription', TextType::class,[
                'required' => false
            ])
            ->add('description', TextType::class,[
                'required' => false
            ])
            ->add('date', TextType::class,[
                'required' => false
            ])
            ->add('link', TextType::class,[
                'required' => false
            ])
            ->add('image', EntityType::class, array(
                'class' => 'AppBundle:Image',
                'choice_label' => function ($image) {
                    return $image->getName();
                }))
            ->add('Submit', SubmitType::class)
            ->getForm();
    }
}