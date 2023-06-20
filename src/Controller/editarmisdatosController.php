<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UsuarioType;

class editarmisdatosController extends AbstractController
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/editarmiperfil', name: 'app_editarmiperfil')]
    public function editarDatos(Request $request): Response
    {
        $usuario = $this->getUser();
        
        // Crear el formulario y pasar los datos del usuario actual
        $form = $this->createForm(UsuarioType::class, $usuario);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Guardar los cambios en la base de datos
            $this->entityManager->persist($usuario);
            $this->entityManager->flush();
            
            // Redirigir a la página de perfil después de guardar los cambios
            return $this->redirectToRoute('app_miperfil');
        }
        
        return $this->render('perfilusuario/editardatos.html.twig', [
            'form' => $form->createView(),
            'usuario' => $usuario,
        ]);
    }
}