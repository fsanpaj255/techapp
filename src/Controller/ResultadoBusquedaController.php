<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResultadoController extends AbstractController
{
    #[Route('/resultado/busqueda', name: 'resultado_busqueda')]
    public function mostrarResultado(Request $request)
    {
        // Obtener los datos del producto encontrado enviados desde el frontend
        $productoBuscado = $request->request->get('datos')[0];

        // Renderizar la plantilla Twig y pasar los datos del producto a la plantilla
        return $this->render('resultadob/busqueda.html.twig', [
            'producto' => $productoBuscado,
        ]);
    }
}