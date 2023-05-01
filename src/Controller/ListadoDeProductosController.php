<?php

namespace App\Controller;

use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ListadoDeProductosController extends AbstractController
{


#[Route('/listadoproductos', name: 'listadode_productos')]
    public function listadoJuegos(ProductoRepository $productosRepository): Response
    {
        return $this->render('listadojuegos/index.html.twig', [
            'listaproductos' => $productosRepository->findAll(),
        ]);
    }


}