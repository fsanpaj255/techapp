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
        // Obtener los datos del cuerpo de la solicitud
        $contenido = $request->getContent();

        // Decodificar los datos JSON
        $datos = json_decode($contenido, true);

        // Verificar si la decodificación es exitosa y los datos no son nulos
        if (is_array($datos) && !empty($datos)) {
            $productos = $datos['productos'];
            $precioTotal = $datos['precio'];

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