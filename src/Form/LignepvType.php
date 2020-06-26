<?php

namespace App\Form;

use App\Entity\Lignepv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LignepvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produit',TextType::class,[
                'attr'=>['class'=>'form-control py-4 col text-capitalize','placeholder'=>'Entrer Produit'],
                'label_attr' => ['class' => 'm-0 font-weight-bold text-primary ']
            ])
            ->add('quantite',NumberType::class,[
                'attr'=>['class'=>'form-control py-4 col','placeholder'=>'Entrer Quantite', 'step'=>'0.01','min' => 0,],
                'label_attr'=>['class'=>'m-0 font-weight-bold text-primary  '] ,
                'html5' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lignepv::class,
        ]);
    }
}
