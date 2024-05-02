<?php

namespace App\Form;

use App\Entity\Sortie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Campus;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('s_nom', TextType::class, [
                'label' => 'Nom de la sortie',
                'attr' => ['placeholder' => 'Nom de la sortie'],
            ])
            ->add('s_description', TextareaType::class, [
                'label' => 'Description de la sortie',
                'attr' => ['placeholder' => 'Description de la sortie'],
            ])
            ->add('s_date_heure_debut', DateTimeType::class, [
                'label' => 'Date et heure de début',
            ])
            ->add('s_duree', TimeType::class, [
                'label' => 'Durée',
            ])
            ->add('s_date_limite_inscription', DateTimeType::class, [
                'label' => 'Date limite d\'inscription',
            ])
            ->add('s_nombre_inscription_max', IntegerType::class, [
                'label' => 'Nombre maximum d\'inscriptions',
            ])
            ->add('s_campus', EntityType::class, [
                'class' => Campus::class,
                'label' => 'Campus',
                'choice_label' => 'nom',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
