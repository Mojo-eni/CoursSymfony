<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Truc;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrucType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder->add("libelle")
        ->add('category', EntityType::class, [
        'class' => Category::class,
        'choice_label' => 'id',
        'placeholder' => 'Choose a category',
        'required' => true,
    ])
        ->add('user', EntityType::class,[
            'class' => User::class,
            'required' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(["data_class" => Truc::class]);
    }
}