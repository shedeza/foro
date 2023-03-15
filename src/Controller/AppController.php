<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('app/')]
class AppController extends AbstractController
{
    #[Route('contacto/')]
    public function contacto()
    {
        return $this->render('app/contacto.html.twig');
    }

    #[Route('/{nombre}', name: 'app_app')]
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
