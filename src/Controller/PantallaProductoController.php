<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Producto;

class PantallaProductoController extends AbstractController
{
    #[Route('/pantallaProducto', name: 'app_pantalla_producto')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->query->get('id');
          // Obtener el objeto Producto por su identificación
          $producto = $entityManager->getRepository(Producto::class)->find($id);
            // Serializar el objeto Producto

        return $this->render('pantalla_producto/index.html.twig',  [
            'producto' => $producto,
            // Otros datos para la plantilla
        ]);
    }
}
