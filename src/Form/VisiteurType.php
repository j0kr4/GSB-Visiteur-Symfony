<?php

namespace App\Form;

use App\Entity\Visiteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VisiteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('label' => 'Nom :', 'attr' => array('class' => 'form-control', 'placeholder' => 'Nom...')))
            ->add('prenom', TextType::class, array('label' => 'Prenom :', 'attr' => array('class' => 'form-control', 'placeholder' => 'Prenom...')))
            ->add('adresse', TextType::class, array('label' => 'Adresse :', 'attr' => array('class' => 'form-control', 'placeholder' => 'Adresse...')))
            ->add('ville', TextType::class, array('label' => 'Ville :', 'attr' => array('class' => 'form-control', 'placeholder' => 'Ville...')))
            ->add('cp', TextType::class, array('label' => 'Code postal :', 'attr' => array('class' => 'form-control', 'placeholder' => 'Code postal...')))
            ->add('dateEmbauche', DateType::class, array('label' => 'Date d\'embauche :'))
            ->add('login', TextType::class, array('label' => 'Login :', 'attr' => array('class' => 'form-control', 'placeholder' => 'Login...')))
            ->add('mdp', TextType::class, array('label' => 'Mot de passe :', 'attr' => array('class' => 'form-control', 'placeholder' => 'Mot de passe...')))
            ->add('valider', SubmitType::class, array('label' => 'Valider', 'attr' => array('class' => 'btn btn-primary btn-block')))
            ->add('annuler', ResetType::class, array('label' => 'Quitter', 'attr' => array('class' => 'btn btn-primary btn-block')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visiteur::class,
        ]);
    }
}
