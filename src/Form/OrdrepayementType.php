<?php

namespace App\Form;

use App\Entity\Ordrepayement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdrepayementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('nomf')
            ->add('idbancaire')
            ->add('montant',NumberType::class,[
                'attr'=>[
                    'step'=>'0.01',
                    'value'=>0,
                    'min'=>0
                ]
            ])
            ->add('montantarabe')
            ->add('preuve')
            ->add('letitre')
            ->add('classe')
            ->add('section')
            ->add('paragraph')
            ->add('subparagraph')
            ->add('visa')
            ->add('remisefour',NumberType::class,[
                'attr'=>[
                    'step'=>'0.01',
                    'value'=>0,
                    'min'=>0
                ]
            ])
            ->add('remisetva',NumberType::class,[
                'attr'=>[
                    'step'=>'0.01',
                    'value'=>0,
                    'min'=>0
                ]
            ])
            ->add('totalremise',NumberType::class,[
                'attr'=>[
                    'step'=>'0.01',

                    'jAutoCalc'=>'{remisetva} +  {remisef}'

                ]
            ])
            ->add('montantnet',NumberType::class,[
                'attr'=>[
                    'step'=>'0.01',

                    'jAutoCalc'=>'{mt} - {totalremise}'

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ordrepayement::class,
        ]);
    }
}
