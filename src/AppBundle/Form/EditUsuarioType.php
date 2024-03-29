<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('nombre', TextType::class)
            ->add('apellidos', TextType::class)
            ->add('username', TextType::class,array('label' => 'Usuario'))
            ->add('provincia', ChoiceType::class, array('choices' => 
                [
                    'Pinar del Río' => 'Pinar del Río', 
                    'Artemisa' => 'Artemisa',
                    'La Habana' => 'La Habana',
                    'Mayabeque' => 'Mayabeque',
                    'Matanzas' => 'Matanzas',
                    'Villa Clara' => 'Villa Clara',
                    'Cienfuegos' => 'Cienfuegos Clara',
                    'Sancti Spiritus' => 'Sancti Spiritus',
                    'Ciego de Avila' => 'Ciego de Avila',
                    'Camaguey' => 'Camaguey',
                    'Las Tunas' => 'Las Tunas',
                    'Holguín' => 'Holguín',
                    'Granma' => 'Granma',
                    'Santiago de Cuba' => 'Santiago de Cuba',
                    'Guantánamo' => 'Guantánamo',
                ]))
            ->add('edit', SubmitType::class, array('label' => 'Editar'))
        ;
    }   
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Usuario'
        ]);
    }

}