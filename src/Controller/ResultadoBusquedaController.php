<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultadoBusquedaController extends AbstractController
{
    #[Route('/resultado/busqueda', name: 'app_resultado_busqueda')]
    public function index(): Response
    {
        return $this->render('resultado_busqueda/index.html.twig', [
            'controller_name' => 'ResultadoBusquedaController',
        ]);
    }
}
