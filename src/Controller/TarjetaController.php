<?php

namespace App\Controller;

use App\Entity\Tarjeta;
use App\Form\TarjetaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TarjetaController extends AbstractController
{

    
     #[Route('/guardar-tarjeta', name: 'guardar_tarjeta')]
    public function guardarTarjeta(Request $request,EntityManagerInterface $entityManager): Response
    {
        // Verificar si el usuario está logueado
        $usuario = $this->getUser();
        if (!$usuario) {
            // El usuario no está logueado, redirigir a la página de login o mostrar un mensaje de error
            return $this->redirectToRoute('app_login');
        }

        // Crear una nueva instancia de la entidad Tarjeta
        $tarjeta = new Tarjeta();

        // Crear el formulario y asociarlo a la entidad Tarjeta
        $form = $this->createForm(TarjetaType::class, $tarjeta);
        // Manejar la solicitud del formulario
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Asignar el usuario logueado a la tarjeta
            $tarjeta->setUsuarioid($usuario);

            // Guardar la tarjeta en la base de datos
           $entityManager->persist($tarjeta);
            $entityManager->flush();

            return $this->redirectToRoute('app_pago');
        }

        // Renderizar la plantilla del formulario
        return $this->render('pago/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}