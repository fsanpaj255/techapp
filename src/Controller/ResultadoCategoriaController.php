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
        // Obtener todos los productos
        $todosLosProductos = $this->productoRepository->findAll();

        // Filtrar los productos por la categoría seleccionada
        $productosPorCategoria = array_filter($todosLosProductos, function ($producto) use ($categoria) {
            return $producto->getCategoria() === $categoria;
        });

        return $this->render('resultado/porcategoria.html.twig', [
            'categoria' => $categoria,
            'productos' => $productosPorCategoria,
        ]);
    }
}