<?php

namespace App\Form;

use App\Entity\Rubrique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RubriqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code',TextType::class,['label' => false,
                'attr'=>[ 'class'=>'form-control py-4 col','placeholder'=>'Entrer Code','min' => 0,],
                'label_attr' => ['class' => 'm-0 font-weight-bold text-primary ']

            ])
            ->add('titre',TextType::class,['label' => false,
                'attr'=>[ 'class'=>'form-control py-4 col','placeholder'=>'Entrer Titre'],
                'label_attr' => ['class' => 'm-0 font-weight-bold text-primary ']
            ])
                ->add('montant',NumberType::class,['label' => false,
                'attr'=>[ 'class'=>'form-control py-4 col','placeholder'=>'Entrer Montant','step'=>'0.01','min' => 0,],
                'label_attr' => ['class' => 'm-0 font-weight-bold text-primary '],
                    'html5' => true,




                ])

            ->add('engp',HiddenType::class,[
                'attr'=>['class'=>'form-control py-4 col','placeholder'=>'Entrer Engagement non payè'
                    ,'step'=>'0.01','min' => 0,],
                'label_attr' => ['class' => 'm-0 font-weight-bold text-primary '],
                'label' =>'Engagement non payè',
                'empty_data'=>0

            ])

            ->add('engnp',HiddenType::class,[
                'attr'=>['class'=>'form-control py-4 col','placeholder'=>'Entrer Engagement payè'
                    ,'step'=>'0.01','min' => 0, 'hidden' => true],
                'label_attr' => ['class' => 'm-0 font-weight-bold text-primary '],
                'label' =>'Engagement payè',
                'empty_data'=>0

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rubrique::class,
        ]);
    }
}
