<?php

namespace App\Controller;

use App\Repository\OfertaRepository;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    #[Route('/', name: 'app_landing')]
    public function listadoprodcutos(Request $request, ProductoRepository $productoRepository, OfertaRepository $ofertaRepository): Response
    {
        $categoria = $request->query->get('categoria');

        if ($categoria) {
            $productos = $productoRepository->findBy(['categoria' => $categoria]);
        } else {
            $productos = $productoRepository->findAll();
        }

        
        foreach ($productos as $producto) {
            $oferta = $ofertaRepository->findOneBy(['productoid' => $producto]);

            if ($oferta) {
                $producto->setOferta($oferta);
            }
        }

        return $this->render('landing/index.html.twig', [
            'listaproductos' => $productos,
            'categoriaSeleccionada' => $categoria,
        ]);
    }
}

