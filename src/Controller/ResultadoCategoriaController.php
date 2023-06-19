<?php

namespace App\Controller;

use App\Repository\OfertaRepository;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultadoCategoriaController extends AbstractController
{
    private $productoRepository;
    private $ofertaRepository;

    public function __construct(ProductoRepository $productoRepository, OfertaRepository $ofertaRepository)
    {
        $this->productoRepository = $productoRepository;
        $this->ofertaRepository = $ofertaRepository;
    }

    #[Route('/productos/{categoria}', name: 'productos_por_categoria')]
    public function mostrarProductosPorCategoria(Request $request, string $categoria): Response
    {
        // Obtener todos los productos por categoría
        $productosPorCategoria = $this->productoRepository->findByCategoria($categoria);

        // Obtener las ofertas para los productos encontrados
        $ofertasPorProducto = [];
        foreach ($productosPorCategoria as $producto) {
            $oferta = $this->ofertaRepository->findOneBy(['productoid' => $producto]);

            if ($oferta) {
                $ofertasPorProducto[$producto->getId()] = $oferta;
            }
        }

        return $this->render('resultado/porcategoria.html.twig', [
            'categoria' => $categoria,
            'productos' => $productosPorCategoria,
            'ofertas' => $ofertasPorProducto,
        ]);
    }
}