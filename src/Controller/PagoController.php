<?php

namespace App\Controller;

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


                // Crear una nueva instancia de la entidad Tarjeta
                $tarjeta = new Tarjeta();
                $direccion = new Direccion();

                // Crear el formulario y asociarlo a la entidad Tarjeta
                $form = $this->createForm(TarjetaType::class, $tarjeta);
                // Manejar la solicitud del formulario
                $form->handleRequest($request);

                // Crear el formulario y asociarlo a la entidad Direccion
                $form2 = $this->createForm(DireccionType::class, $direccion);
                // Manejar la solicitud del formulario
                $form2->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Asignar el usuario logueado a la tarjeta
                    $tarjeta->setUsuarioid($usuario);
                    $direccion->setUsuarioid($usuario);

                    // Guardar la tarjeta en la base de datos
                    $entityManager->persist($tarjeta);
                    $entityManager->flush();
                       // Guardar la direccion en la base de datos
                       $entityManager->persist($direccion);
                       $entityManager->flush();
                    return $this->redirectToRoute('app_landing');
                }
            
            // Renderizar la plantilla y pasar los datos necesarios
            return $this->render('pago/index.html.twig', [
                'productos' => $productosContados,
                'total' => $precioTotal,
                'form' => $form->createView(),
                'form2' => $form2->createView(),
            ]);
        } else {
            // Manejar el caso cuando no se obtuvieron los datos correctamente
            return new Response('Error al obtener los datos', Response::HTTP_BAD_REQUEST);
        }
    }
}