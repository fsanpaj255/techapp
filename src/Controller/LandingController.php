<?php

namespace App\Controller;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    #[Route('/', name: 'app_landing')]
    public function listadoJuegos(ProductoRepository $productosRepository): Response
    {
        return $this->render('landing/index.html.twig', [
            'listaproductos' => $productosRepository->findAll(),
        ]);
    }
}
