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

class AñadirTarjetaController extends AbstractController
{
    #[Route('/tarjeta', name: 'app_tarjeta')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
       
             // Verificar si el usuario está logueado
                $usuario = $this->getUser();
                if (!$usuario) {
                    // El usuario no está logueado, redirigir a la página de login o mostrar un mensaje de error
                    return $this->redirectToRoute('app_login');
                }
                // Crear una nueva instancia de la entidad Tarjeta
                $tarjeta = new Tarjeta();

                // Crear el formulario y asociarlo a la entidad Direccion
                $form = $this->createForm(TarjetaType::class, $tarjeta);
                // Manejar la solicitud del formulario
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Asignar el usuario logueado a la direccion
                    $tarjeta->setUsuarioid($usuario);
                       // Guardar la direccion en la base de datos
                       $entityManager->persist($tarjeta);
                       $entityManager->flush();
                    return $this->redirectToRoute('app_direccion');
                }
            
            // Renderizar la plantilla y pasar los datos necesarios
            return $this->render('formulariotarjeta/tarjeta.html.twig', [
                'form' => $form->createView(),
            ]);
    }
}