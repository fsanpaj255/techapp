<?php

namespace App\Controller;

use App\Entity\Pedido;
use App\Entity\Tarjeta;
use App\Entity\Direccion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TarjetaType;
use App\Form\DireccionType;

class PagoController extends AbstractController
{
    #[Route('/pago', name: 'app_pago', methods: ['POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
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

            // Verificar si el usuario está logueado
            $usuario = $this->getUser();
            if (!$usuario) {
                // El usuario no está logueado, redirigir a la página de login o mostrar un mensaje de error
                return $this->redirectToRoute('app_login');
            }
             // Obtener la primera tarjeta del usuario
             $primeratarjeta = $entityManager->getRepository(Tarjeta::class)->findOneBy(['usuarioid' => $usuario]);

             // Obtener el número de tarjeta
             $numeroTarjeta = $primeratarjeta ? $primeratarjeta->getNumerotarjeta() : null;

            // Reemplazar los digitos de la tarjeta para censurarla con * 
            if ($numeroTarjeta) {
                $longitudTarjeta = strlen($numeroTarjeta);
                $ultimosCuatroDigitos = substr($numeroTarjeta, -4);
                $asteriscos = str_repeat('*', $longitudTarjeta - 4);
                $numeroTarjeta = $asteriscos . $ultimosCuatroDigitos;
            }

             // Obtener la primera tarjeta del usuario
             $primeradireccion = $entityManager->getRepository(Direccion::class)->findOneBy(['usuarioid' => $usuario]);

             // Obtener el número de tarjeta
             $calle = $primeradireccion ? $primeradireccion->getCalle() : null;
             $codigopostal = $primeradireccion ? $primeradireccion->getCodigopostal() : null;
             $ciudad = $primeradireccion ? $primeradireccion->getCiudad() : null;
             $provincia = $primeradireccion ? $primeradireccion->getProvincia() : null;
             $pais = $primeradireccion ? $primeradireccion->getPais() : null;

                 if ($request->request->has('btn-realizar-pedido')) {
                // Crear una nueva instancia de Pedido
                $pedido = new Pedido();

                // Establecer el usuario logueado como el usuarioid del pedido
                $pedido->setUsuarioid($usuario);

                // Establecer los productos comprados en el pedido
                $pedido->setProductoscomprados($productos);

                // Guardar el pedido en la base de datos
                $entityManager->persist($pedido);
                $entityManager->flush();
                return $this->redirectToRoute('app_landing');
                 }

            // Renderizar la plantilla y pasar los datos necesarios
            return $this->render('pago/index.html.twig', [
                'productos' => $productosContados,
                'total' => $precioTotal,
                'numeroTarjeta' => $numeroTarjeta,
                'calle' => $calle,
                'codigopostal' => $codigopostal,
                'ciudad' => $ciudad,
                'provincia' => $provincia,
                'pais' => $pais,
            ]);
        } else {
            // Manejar el caso cuando no se obtuvieron los datos correctamente
            return new Response('Error al obtener los datos', Response::HTTP_BAD_REQUEST);
        }
    }
}