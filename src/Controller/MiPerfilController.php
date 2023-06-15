<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MiPerfilController extends AbstractController
{
    #[Route('/miperfil', name: 'app_miperfil')]
    public function index(): Response
    {
        $usuario = $this->getUser(); // Obtener el usuario logueado
        return $this->render('perfilusuario/index.html.twig', [
            'usuario' => $usuario,
        ]);
    }
}
