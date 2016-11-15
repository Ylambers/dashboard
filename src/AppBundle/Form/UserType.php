<?php
/**
 * Created by PhpStorm.
 * User: ylamb
 * Date: 10-11-2016
 * Time: 18:06
 */

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enabled', CheckboxType::class, [
                'required' => false
            ])
            ->add('username', TextType::class,[
            ])
            ->add('email', TextType::class,[])

            ->add('plainPassword',          RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat password'),
                'invalid_message' => 'fos_user.password.mismatch',
                'required' => false
            ))

            ->add(
                'roles', ChoiceType::class, [
                    'choices' => ['User' => 'ROLE_USER', 'Admin' => 'ROLE_ADMIN', 'Super admin' => 'ROLE_SUPER_ADMIN'],
                    'expanded' => true,
                    'multiple' => true,
                ]
            )
            ->add('Submit', SubmitType::class)
            ->getForm();
    }
}