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

        $precioJSON = $request->query->get('precio');
        $precio = json_decode($precioJSON, true);

        //cantidad de productos
                $productosContados = [];
        foreach ($productos as $producto) {
            $nombre = $producto['nombre'];
            if (isset($productosContados[$nombre])) {
                $productosContados[$nombre]++;
            } else {
                $productosContados[$nombre] = 1;
            }
}
        // Verificar si se obtuvieron los productos correctamente
        if (is_array($productos)) {
            // Aquí puedes realizar cualquier lógica adicional con los productos, como guardarlos en la base de datos, realizar operaciones, etc.

            // Renderiza la plantilla y pasa los productos como variable
            return $this->render('pago/index.html.twig', [
                'productos' => $productosContados,
                'precio' => $precio
            ]);
        } else {
            // Manejar el caso cuando no se obtuvieron los productos correctamente
            return new Response('Error al obtener los productos', Response::HTTP_BAD_REQUEST);
        }
    }
}