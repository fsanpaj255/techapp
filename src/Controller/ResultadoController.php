<?php

namespace App\Controller;

use App\Repository\ProductoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Producto;

class ResultadoController extends AbstractController
{
    private $productoRepository;

    public function __construct(ProductoRepository $productoRepository)
    {
        $this->productoRepository = $productoRepository;
    }
    #[Route('/buscar_producto', name: 'buscar_producto')]
    public function buscarProducto(Request $request)
    {
        $nombreProducto = $request->query->get('nombreProducto');

        // Realizar la búsqueda del producto por nombre
        $producto = $this->productoRepository->findOneByNombre($nombreProducto);

        // Obtener la categoría del producto buscado
        $categoria = $producto->getCategoria();
         // Obtener todos los productos que comparten la misma categoría si la categoría no es nula
        $productosRelacionados = null;
        if ($categoria !== null) {
        // Obtener todos los productos que comparten la misma categoría
        $productosRelacionados = $this->productoRepository->findByCategoria($categoria);
    }
        return $this->render('resultado/index.html.twig', [
            'producto' => $producto,
            'productosRelacionados' => $productosRelacionados,
        ]);
    }
}