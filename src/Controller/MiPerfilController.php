<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MiPerfilController extends AbstractController
{
    #[Route('/mi/perfil', name: 'app_mi_perfil')]
    public function index(): Response
    {
        return $this->render('mi_perfil/index.html.twig', [
            'controller_name' => 'MiPerfilController',
        ]);
    }
}
