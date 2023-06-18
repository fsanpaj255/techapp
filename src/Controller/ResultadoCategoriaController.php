<?php

namespace App\Controller;

use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultadoCategoriaController extends AbstractController
{
    private $productoRepository;

    public function __construct(ProductoRepository $productoRepository)
    {
        $this->productoRepository = $productoRepository;
    }

    #[Route('/productos/{categoria}', name: 'productos_por_categoria')]
    public function mostrarProductosPorCategoria(Request $request, string $categoria): Response
    {
        // Obtener todos los productos por la categoría seleccionada
        $productosPorCategoria = $this->productoRepository->findBy([
            'categoria' => $categoria
        ]);

        return $this->render('resultado/porcategoria.html.twig', [
            'categoria' => $categoria,
            'productosPorCategoria' => $productosPorCategoria,
        ]);
    }
}