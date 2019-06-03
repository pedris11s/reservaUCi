<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder 
            ->add('origen', TextType::class)
            ->add('destino', TextType::class)
            ->add('fecha', DateTimeType::class, [
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                ]
            ])
            ->add('tipo', ChoiceType::class, array('choices' => ['Ida' => 'Ida', 'Regreso' => 'Regreso']))
            ->add('save', SubmitType::class, array('label'=>'Adicionar'))
        ;
    }          

}