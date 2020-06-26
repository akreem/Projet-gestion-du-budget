<?php

namespace App\Form;

use App\Entity\LigneRecap;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneRecapType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            ->add('tva',NumberType::class)
            ->add('produit',TextType::class)
            ->add('pu_ht',NumberType::class)
            ->add('totalht',NumberType::class,[
                'attr'=>[
                    'jAutoCalc'=>'{qty1} * {price1}'

                ]
            ])
            ->add('montanttva',NumberType::class,[
                'attr'=>[
                    'step'=>'0.001',
                    'jAutoCalc'=>'{ttht1} * {ttva1}/100'

                ],
                'empty_data'=>'0'
            ])
            ->add('totalttc',NumberType::class,[
                'attr'=>[
                    'step'=>'0.001',
                    'jAutoCalc'=>'{ttht1} + {totaltva}'

                ],
                'empty_data'=>'0'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigneRecap::class,
        ]);
    }
}
