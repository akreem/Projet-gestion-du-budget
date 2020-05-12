<?php

namespace App\Form;

use App\Entity\Devis;
use App\Entity\TabRecap;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecapType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num')
            ->add('devis',EntityType::class,[
                'class'=>Devis::class,
                'placeholder' => 'Selectionner un devis'
            ])
            ->add('Valider',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary btn-block'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TabRecap::class,
        ]);
    }
}
