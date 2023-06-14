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
                    // El usuario no está logueado, ir  al login 
                    return $this->redirectToRoute('app_login');
                }

                $direccion = new Direccion();

                // Crear el formulario de direccion
                $form = $this->createForm(DireccionType::class, $direccion);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Asignar el usuario logueado a la direccion
                    $direccion->setUsuarioid($usuario);
                       $entityManager->persist($direccion);
                       $entityManager->flush();
                    return $this->redirectToRoute('app_pago');
                }
            
            return $this->render('formulariodireccion/direccion.html.twig', [
                'form' => $form->createView(),
            ]);
    }
}