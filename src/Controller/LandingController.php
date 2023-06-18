<?php

namespace App\Controller;

use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    #[Route('/', name: 'app_landing')]
    public function listadoJuegos(Request $request, ProductoRepository $productoRepository): Response
    {
        $categoria = $request->query->get('categoria');

        if ($categoria) {
            $productos = $productoRepository->findBy(['categoria' => $categoria]);
        } else {
            $productos = $productoRepository->findAll();
        }

        return $this->render('landing/index.html.twig', [
            'listaproductos' => $productos,
            'categoriaSeleccionada' => $categoria,
        ]);
    }
}

