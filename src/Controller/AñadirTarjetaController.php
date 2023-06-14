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
                    // El usuario no está logueado, ir al login o mostrar un mensaje de error
                    return $this->redirectToRoute('app_login');
                }
               
                $tarjeta = new Tarjeta();

                // Crear el formulario ¡tarjeta
                $form = $this->createForm(TarjetaType::class, $tarjeta);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Asignar el usuario logueado a la direccion
                    $tarjeta->setUsuarioid($usuario);
                     
                       $entityManager->persist($tarjeta);
                       $entityManager->flush();
                    return $this->redirectToRoute('app_direccion');
                }
            
           
            return $this->render('formulariotarjeta/tarjeta.html.twig', [
                'form' => $form->createView(),
            ]);
    }
}