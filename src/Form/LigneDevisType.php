<?php

namespace App\Form;

use App\Entity\Devis;
use App\Entity\DevisVierge;
use App\Entity\LigneDevis;
use phpDocumentor\Reflection\Types\Float_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneDevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produit',TextType::class)
            ->add('quantite',NumberType::class,[
                'attr'=>['class'=>'form-control py-4 col','placeholder'=>'Entrer Engagement non payè'
                    ,'step'=>'0.01','min' => 0,],
                'label_attr' => ['class' => 'm-0 font-weight-bold text-primary '],
                'html5' => true,

            ])
            ->add('pu_ht',NumberType::class,[
                'attr'=>['class'=>'form-control py-4 col','placeholder'=>'Entrer Engagement non payè'
                    ,'step'=>'0.01','min' => 0,],
                'label_attr' => ['class' => 'm-0 font-weight-bold text-primary '],
                'html5' => true,

            ])
            ->add('tva',NumberType::class,[
                'attr'=>['class'=>'form-control py-4 col','placeholder'=>'Entrer Engagement non payè'
                    ,'step'=>'0.01','min' => 0,],
                'label_attr' => ['class' => 'm-0 font-weight-bold text-primary '],
                'html5' => true,

            ])
            ->add('total_ht',NumberType::class,[
                'attr'=>[
                    'jAutoCalc'=>'{qty} * {price}'

                ],
                'empty_data'=>'0'
            ])

        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigneDevis::class,
        ]);
    }
}
