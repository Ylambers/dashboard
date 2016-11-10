<?php
/**
 * Created by PhpStorm.
 * User: ylamb
 * Date: 10-11-2016
 * Time: 18:06
 */

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $permissions = array(
            'ROLE_USER'        => 'First role',
            'ROLE_CONSULT'     => 'Second role',
            'ROLE_SUPER_ADMIN' => 'Third role'
        );

        $builder
            ->add('username', TextType::class,[
            ])
            ->add('email', TextType::class,[])
            ->add('roles', 'choice', array(
                'choices' => $this->getExistingRoles(),
                'data' => $group->getRoles(),
                'label' => 'Roles',
                'expanded' => true,
                'multiple' => true,
                'mapped' => true,
            ))
            ->add('Submit', SubmitType::class)
            ->getForm();
    }

    public function getExistingRoles()
    {
//        $roleHierarchy = $this->container->getParameter('security.role_hierarchy.roles');
        $roleHierarchy = $this->
        $roles = array_keys($roleHierarchy);

        foreach ($roles as $role) {
            $theRoles[$role] = $role;
        }
        return $theRoles;
    }
}