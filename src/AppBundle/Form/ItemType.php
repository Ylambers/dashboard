<?php
/**
 * Created by PhpStorm.
 * User: ylamb
 * Date: 27-10-2016
 * Time: 19:22
 */

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('category', EntityType::class, array(
        'class' => 'AppBundle:Category',
        'choice_label' => function ($category) {
            return $category->getName();
        }))
        ->add('title', TextType::class)
        ->add('shortText', TextType::class)
        ->add('text', TextType::class)
        ->add('link', TextType::class)
        ->add('active', CheckboxType::class, [
            'required' => false
        ])
        ->add('imageId', TextType::class)
        ->add('Submit', SubmitType::class)
        ->getForm();
    }
}