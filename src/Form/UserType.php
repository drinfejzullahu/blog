<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name",TextType::class,array('attr'=>array('class'=>'form-control ')))
            ->add('username',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('email',EmailType::class,array(  'attr'=>array( 'type' => 'email', 'class'=>'form-control')))
            ->add('password',PasswordType::class,array(  'attr'=>array( 'type' =>'password', 'class'=>'form-control')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
