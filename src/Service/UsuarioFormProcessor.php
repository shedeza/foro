<?php

namespace App\Service;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsuarioFormProcessor
{
    private FormFactoryInterface $formFactory;
    private UsuarioRepository $usuarioRepository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
        FormFactoryInterface $formFactory,
        UsuarioRepository $usuarioRepository,
        UserPasswordHasherInterface $passwordHasher
    )
    {
        $this->formFactory = $formFactory;
        $this->usuarioRepository = $usuarioRepository;
        $this->passwordHasher = $passwordHasher; 
    }

    public function __invoke(Request $request, Usuario $usuario)
    {
        $passwordOriginal = $usuario->getPassword();

        $form = $this->formFactory->create(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(!$form->has('password') OR (null == $form->getData()->getPassword())){
                $usuario->setPassword($passwordOriginal);
            } else {
                $hashedPassword = $this->passwordHasher->hashPassword(
                    $usuario,
                    $usuario->getPassword()
                );
                $usuario->setPassword($hashedPassword);
            }

            $this->usuarioRepository->save($usuario, true);

            return [$usuario, null];
        }

        // return [$isOk ,  $error]
        return [null , $form];
    }
}