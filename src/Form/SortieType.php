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
            ->add('sNom', TextType::class, [
                'label' => 'Nom de la sortie',
                'attr' => ['placeholder' => 'Nom de la sortie'],
            ])
            ->add('sDescription', TextareaType::class, [
                'label' => 'Description de la sortie',
                'attr' => ['placeholder' => 'Description de la sortie'],
            ])
            ->add('sDateHeureDebut', DateTimeType::class, [
                'label' => 'Date et heure de début',
            ])
            ->add('sDuree', TimeType::class, [
                'label' => 'Durée',
            ])
            ->add('sDateLimiteInscription', DateTimeType::class, [
                'label' => 'Date limite d\'inscription',
            ])
            ->add('sNombreInscriptionMax', IntegerType::class, [
                'label' => 'Nombre maximum d\'inscriptions',
            ])
            ->add('sCampus', EntityType::class, [
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
