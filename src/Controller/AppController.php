<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('app/')]
class AppController extends AbstractController
{
    #[Route('contacto/')]
    public function contacto()
    {
        return $this->render('app/contacto.html.twig');
    }

    #[Route('login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('app/login_form.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('logout', name: 'app_logout', methods: ['GET'])]
    public function logout()
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
    
    #[Route('{nombre}', name: 'app_app')]
    public function index(Request $request, string $nombre): Response
    {   
        return $this->render('app/index.html.twig', [
            'nombre' => $nombre,
            'colores' => [
                'rojo',
                'azul',
                'verde',
                'amarillo'
            ],
            'persona' => [
                'nombre' => 'Saul',
                'paterno' => 'Hernandez',
                'materno' => 'Arellano'
            ]

        ]);
    }


}
