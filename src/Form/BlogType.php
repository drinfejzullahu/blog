<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('body',TextareaType::class,array('attr'=>array('class'=>'form-control')))
            ->add('private',null,array('attr'=>array('class'=>'form-check-input ml-2 mt-2' )))
            ->add('photoPath',FileType::class,array('attr'=>array('class'=>'ml-2 mr-2 mt-3') , 'label' => 'Photo','data_class'=>null ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
