<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultadoBusquedaController extends AbstractController
{
    #[Route("/resultado/busqueda", name: "resultado_busqueda")]
    public function mostrarResultadoBusqueda(Request $request): Response
    {
        // Obtener los datos enviados desde jQuery
        $datos = $request->get('datos');

        // Renderizar la plantilla Twig y pasar los datos como variables
        return $this->render('resultado_busqueda/index.html.twig', [
            'datos' => $datos,
        ]);
    }
}
