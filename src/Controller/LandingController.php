<?php

namespace App\Controller;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

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
