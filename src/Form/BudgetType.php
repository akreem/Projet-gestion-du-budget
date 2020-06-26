<?php

namespace App\Form;

use App\Entity\Budget;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BudgetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annee',ChoiceType::class,[
                'choices'=>[
                    '2020'=>2020,
                    '2021'=>2021,
                    '2022'=>2022,
                    '2023'=>2023,
                    '2024'=>2024,
                ]
            ])
            ->add('totalht',NumberType::class)

            ->add('totalnpaye',HiddenType::class,[
                'attr'=>[
                    'jAutoCalc'=>'SUM({enp})'],
                'empty_data'=>0
            ])

            ->add('totalpaye',HiddenType::class,[
                'attr'=>[
                    'jAutoCalc'=>'SUM({ep})'],
                'empty_data'=>0
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
