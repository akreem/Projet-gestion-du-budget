<?php

namespace App\Form;

use App\Entity\DevisVierge;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class DevisViergeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('date_limite',DateType::class,[
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datepicker1'],
                'empty_data' => 'Select a date'
            ])
            ->add('nb_devis_edit')
            ->add('rubrique')
            ->add('ligneDevisVierges',CollectionType::class,[
                'entry_type' => LigneDevisViergeType::class,
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
            'data_class' => DevisVierge::class,
        ]);
    }
}
