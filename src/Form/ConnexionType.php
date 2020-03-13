<?php

namespace App\Form;

use App\Entity\Visiteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ConnexionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
