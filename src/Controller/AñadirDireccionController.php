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

class AñadirDireccionController extends AbstractController
{
    #[Route('/direccion', name: 'app_direccion')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
       
             // Verificar si el usuario está logueado
                $usuario = $this->getUser();
                if (!$usuario) {
                    // El usuario no está logueado, redirigir a la página de login o mostrar un mensaje de error
                    return $this->redirectToRoute('app_login');
                }


                // Crear una nueva instancia de la entidad Direcciond
                $direccion = new Direccion();

                // Crear el formulario y asociarlo a la entidad Direccion
                $form = $this->createForm(DireccionType::class, $direccion);
                // Manejar la solicitud del formulario
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Asignar el usuario logueado a la direccion
                    $direccion->setUsuarioid($usuario);
                       // Guardar la direccion en la base de datos
                       $entityManager->persist($direccion);
                       $entityManager->flush();
                    return $this->redirectToRoute('app_pago');
                }
            
            // Renderizar la plantilla y pasar los datos necesarios
            return $this->render('formulariodireccion/direccion.html.twig', [
                'form' => $form->createView(),
            ]);
    }
}