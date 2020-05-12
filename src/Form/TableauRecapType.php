<?php

namespace App\Form;

use App\Entity\TableauRecap;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TableauRecapType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('totalht',NumberType::class,[
                'attr'=>[
                    'jAutoCalc'=>'SUM({ttht1})'

                ]
            ])

            ->add('totaltva',NumberType::class,[
                'attr'=>[
                    'jAutoCalc'=>'SUM({ttva1})'

                ]
            ])
            ->add('totalttc',NumberType::class,[
                'attr'=>[
                    'full_name'=>'grand_total1',
                    'class'=>'form-control form-control-sm',
                    'readonly'=>'true',
                    'jAutoCalc'=>'{total_tva1} + {total_ht1}'

                ],


            ])
            ->add('num',HiddenType::class)
            ->add('annee',HiddenType::class)
            ->add('nomfournisseur',HiddenType::class)
            ->add('ligneRecaps', CollectionType::class, [
                'entry_type' => LigneRecapType::class,
                'label' => false,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TableauRecap::class,
        ]);
    }
}
