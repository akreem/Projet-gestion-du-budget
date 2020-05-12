<?php

namespace App\Form;

use App\Entity\Devis;
use App\Entity\LigneDevis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomFournisseur')
            ->add('AddrFournisseur')
            ->add('MatriculeFiscaleFourn',TextType::class,[
                'attr'=>['maxlength'=>'16']
            ])
            ->add('TelFourn',TextType::class,[
                'attr'=>['maxlength'=>'8']
            ])
            ->add('FaxFourn',TextType::class,[
                'attr'=>['maxlength'=>'8']
            ])




            ->add('total_HT',NumberType::class,[
                'attr'=>[
                    'jAutoCalc'=>'SUM({ttht})'

                ]
            ])

            ->add('total_tva',NumberType::class,[
                'attr'=>[
                    'jAutoCalc'=>'SUM({ttva})'

                ]
            ])

                ->add('total_ttc',NumberType::class,[
                'attr'=>[
                'full_name'=>'grand_total1',
                'class'=>'form-control form-control-sm',
                'readonly'=>'true',
                    'jAutoCalc'=>'{total_tva} + {total_ht}'

                ],


            ])

            ->add('ligneDevis', CollectionType::class, [
                'entry_type' => LigneDevisType::class,
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
            'data_class' => Devis::class,
        ]);
    }
}
