<?php

namespace App\Form;

use App\Entity\Budget;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BudgetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee',NumberType::class)
            ->add('date',DateType::class,[
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker'],
                'empty_data' => 'Select a date'

            ])
            ->add('totalht',NumberType::class)
            ->add('totalnpaye',NumberType::class,[
                'attr'=>[
                    'jAutoCalc'=>'SUM({enp})'

                ]
            ])
            ->add('totalpaye',NumberType::class,[
                'attr'=>[
                    'jAutoCalc'=>'SUM({ep})'

                ]
            ])
            ->add('rubriques',CollectionType::class,[
                'entry_type' => RubriqueType::class,
                'label' => false,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Budget::class,
        ]);
    }
}
