<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;





class VoitureType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('matricule',TextType::class)
            ->add('marque',TextType::Class)
            ->add('couleur',TextType::Class)
            ->add('carburant',TextType::Class)
            ->add('description',TextareaType::Class)
            ->add('datemiseencirculation',DateTimeType::Class)
            ->add('nbrplace',IntegerType::Class,array('attr'=> array('min'=>1)))

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
