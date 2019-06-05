<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class EditReservacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder 
            ->add('origen', ChoiceType::class, array('choices' => 
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
            ->add('destino', ChoiceType::class, array('choices' => 
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
            ->add('fecha', DateTimeType::class, [
                'placeholder' => [
                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
                    'hour' => 'Hora', 'minute' => 'Minuto', 'second' => 'Second',
                ]
            ])
            ->add('tipo', ChoiceType::class, array('choices' => ['Ida' => 'Ida', 'Regreso' => 'Regreso']))
            ->add('edit', SubmitType::class, array('label'=>'Editar'))
        ;
    }        
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Reservacion'
        ]);
    }

}