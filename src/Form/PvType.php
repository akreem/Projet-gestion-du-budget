<?php

namespace App\Form;

use App\Entity\Pv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commentaire')
            ->add('cad1')
            ->add('cad2')
            ->add('cad3')
            ->add('cad4')
            ->add('cad5')
            ->add('grade1',ChoiceType::class,[
                'choices'=>[
                    'العقيد'=>'العقيد',
                    'المقدم'=>'المقدم',
                    'الرائد'=>'الرائد',
                    'النقيب'=>'النقيب',
                    'الملازم أول'=>'الملازم أول',

                ]
            ])
            ->add('grade2',ChoiceType::class,[
                'choices'=>[
                    'المقدم'=>'المقدم',
                    'الرائد'=>'الرائد',
                    'النقيب'=>'النقيب',
                    'الملازم أول'=>'الملازم أول',
                    'الملازم '=>'الملازم ',
                    'الوكيل اعلى'=>'الوكيل اعلى',
                    'الوكيل اول' =>'الوكيل اول',
                    'الوكيل '=>'الوكيل ',
                    'العريف اول'=>'العريف اول',
                    'العريف '=>'العريف ',
                ]
            ])
            ->add('grade3',ChoiceType::class,[
                'choices'=>[
                    'الرائد'=>'الرائد',
                    'النقيب'=>'النقيب',
                    'الملازم أول'=>'الملازم أول',
                    'الملازم '=>'الملازم ',
                    'الوكيل اعلى'=>'الوكيل اعلى',
                    'الوكيل اول' =>'الوكيل اول',
                    'الوكيل '=>'الوكيل ',
                    'العريف اول'=>'العريف اول',
                    'العريف '=>'العريف ',
                ]
            ])
            ->add('grade4',ChoiceType::class,[
                'choices'=>[

                    'النقيب'=>'النقيب',
                    'الملازم أول'=>'الملازم أول',
                    'الملازم '=>'الملازم ',
                    'الوكيل اعلى'=>'الوكيل اعلى',
                    'الوكيل اول' =>'الوكيل اول',
                    'الوكيل '=>'الوكيل ',
                    'العريف اول'=>'العريف اول',
                    'العريف '=>'العريف ',

                ],
            ])
            ->add('grade5',ChoiceType::class,[
                'choices'=>[

                    'الملازم أول'=>'الملازم أول',
                    'الملازم '=>'الملازم ',
                    'الوكيل اعلى'=>'الوكيل اعلى',
                    'الوكيل اول' =>'الوكيل اول',
                    'الوكيل '=>'الوكيل ',
                    'العريف اول'=>'العريف اول',
                    'العريف '=>'العريف ',
                ]
            ])

            ->add('lignepvs',CollectionType::class,[
                'entry_type' => LignepvType::class,
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
            'data_class' => Pv::class,
        ]);
    }
}
