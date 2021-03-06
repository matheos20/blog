<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Etudiant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre nom',
                    'class' => 'form-control'
                ]
            ])
            ->add('adresse',TextType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre Adresse',
                    'class' => 'form-control'
                ]
            ])
            ->add('age',IntegerType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => '******',
                    'class' => 'form-control'
                ]
            ])
            ->add('classe',EntityType::class,[
                'label' => false,
                'class' => Classe::class,
                'choice_label' => 'libelle',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
