<?php
/**
 * Created by PhpStorm.
 * User: ylamb
 * Date: 27-10-2016
 * Time: 19:31
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class, [
                'required' => false
            ])
            ->add('image',  FileType::class, ['label' => 'Add image'])
            ->add('Submit', SubmitType::class)
            ->getForm();
    }
}