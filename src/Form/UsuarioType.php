<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('createdAt')
            //->add('updatedAt')
            ->add('username')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'ROLE USER' => 'ROLE_USER',
                    'ROLE ADMIN' => 'ROLE_ADMIN',
                ],
                'multiple' => true
            ])
            ->add('password', null, [
                'required' => false,
            ])
            ->add('email')
            ->add('nombre')
            ->add('primerApellido')
            ->add('segundoApellido')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
