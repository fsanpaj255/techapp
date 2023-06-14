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
    public function buscarProducto(Request $request, ProductoRepository $productoRepository)
    {
        $nombreProducto = $request->query->get('nombreProducto');

        // Realizar la búsqueda del producto por nombre
        $producto = $productoRepository->findOneByNombreLike($nombreProducto);

        if (!$producto) {
            //si no hay producto mensaje de error
            $mensajeError = 'No se han encontrado productos.';
            return $this->render('resultado/index.html.twig', [
                'mensajeError' => $mensajeError,
            ]);
        }

        // Obtener la categoría 
        $categoria = $producto->getCategoria();

        // Obtener todos los productos que comparten la misma categoría si la categoría no es nula
        $productosRelacionados = null;
        if ($categoria !== null) {
            // Obtener todos los productos que comparten la misma categoriaa
            $productosRelacionados = $productoRepository->findRelatedProductsByCategoria($producto);
        }

        return $this->render('resultado/index.html.twig', [
            'producto' => $producto,
            'productosRelacionados' => $productosRelacionados,
        ]);
    }
}