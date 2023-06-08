<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagoController extends AbstractController
{
    #[Route('/pago', name: 'app_pago', methods: ['POST'])]
    public function index(Request $request): Response
    {
        // Obtener los datos del cuerpo de la solicitud
        $productosJson = $request->request->get('productos');
        $precioTotalJson = $request->request->get('precio');

        // Decodificar los datos JSON
        $productos = json_decode($productosJson, true);
        $precioTotal = json_decode($precioTotalJson, true);

        // Verificar si la decodificación es exitosa y los datos no son nulos
        if (is_array($productos) && !empty($productos) && is_numeric($precioTotal)) {
            // Contador de productos
            $productosContados = [];
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
            }

            // Renderizar la plantilla y pasar los datos necesarios
            return $this->render('pago/index.html.twig', [
                'productos' => $productosContados,
                'total' => $precioTotal
            ]);
        } else {
            // Manejar el caso cuando no se obtuvieron los datos correctamente
            return new Response('Error al obtener los datos', Response::HTTP_BAD_REQUEST);
        }
    }
}