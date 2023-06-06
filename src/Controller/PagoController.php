<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagoController extends AbstractController
{
    #[Route('/pago', name: 'app_pago')]
    public function index(Request $request): Response
    {
        // Obtener el array de productos desde el parámetro de la URL
        $productosJSON = $request->query->get('productos');
        $productos = json_decode($productosJSON, true);

        // Contador de productos
        $productosContados = [];
        $precioTotal = 0;
        foreach ($productos as $producto) {
            $nombre = $producto['nombre'];
            if (isset($productosContados[$nombre])) {
                $productosContados[$nombre]['cantidad']++;
                $productosContados[$nombre]['precioTotal'] += $producto['precio'];
            } else {
                $productosContados[$nombre] = [
                    'cantidad' => 1,
                    'precio' => $producto['precio'],
                    'precioTotal' => $producto['precio']
                ];
            }
            $precioTotal += $producto['precio'];
        }

        // Verificar si se obtuvieron los productos correctamente
        if (is_array($productos)) {
            // Renderiza la plantilla y pasa los productos como variable
            return $this->render('pago/index.html.twig', [
                'productos' => $productosContados,
                'total' => $precioTotal
            ]);
        } else {
            // Manejar el caso cuando no se obtuvieron los productos correctamente
            return new Response('Error al obtener los productos', Response::HTTP_BAD_REQUEST);
        }
    }
}