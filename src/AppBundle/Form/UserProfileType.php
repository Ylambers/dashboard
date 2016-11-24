<?php
/**
 * Created by PhpStorm.
 * User: yaronlambers
 * Date: 24/11/2016
 * Time: 11:37
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => false
            ])
            ->add('dateOfBirth', TextType::class, [
                'required' => false
            ])
            ->add('emailAddress', TextType::class, [
                'required' => false
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => false
            ])
            ->add('mobileNumber', TextType::class, [
                'required' => false
            ])
            ->add('address', TextType::class, [
                'required' => false
            ])
            ->add('Submit', SubmitType::class)
            ->getForm();
    }
}