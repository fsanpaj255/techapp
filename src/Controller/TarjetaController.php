<?php

namespace App\Controller;

use App\Entity\Tarjeta;
use App\Form\TarjetaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TarjetaController extends AbstractController
{
    /**
     * @Route("/guardar-tarjeta", name="guardar_tarjeta", methods={"POST"})
     */
    public function guardarTarjeta(Request $request): Response
    {
        // Verificar si el usuario está logueado
        $usuario = $this->getUser();
        if (!$usuario) {
            // El usuario no está logueado, redirigir a la página de login o mostrar un mensaje de error
            return $this->redirectToRoute('login');
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tarjeta);
            $entityManager->flush();

            // Redirigir a la página de éxito o mostrar un mensaje de éxito
            return $this->redirectToRoute('exito');
        }

        // Renderizar la plantilla del formulario
        return $this->render('tarjeta/guardar_tarjeta.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}