<?php

namespace App\Controller;

use App\Entity\Pedido;
use App\Entity\Tarjeta;
use App\Entity\Direccion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TarjetaType;
use App\Form\DireccionType;

class finalizarpedidoController extends AbstractController
{
    #[Route('/finalizarpedido', name: 'app_finalizarpedido', methods: ['POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
     // Obtener los datos del formulario
     $productosJson = $request->request->get('productos');
 
     // Decodificar los datos JSON
     $productos = json_decode($productosJson, true);
 
     // Obtener el usuario
     $usuario =   $usuario = $this->getUser();
 
 
               // Crear una nueva instancia de Pedido
          $pedido = new Pedido();

          // Establecer el usuario logueado como el usuarioid del pedido
         $pedido->setUsuarioid($usuario);
                
     // Establecer los productos comprados en el pedido
      $pedido->setProductoscomprados($productos);
                
      // Guardar el pedido en la base de datos
     $entityManager->persist($pedido);
     $entityManager->flush();
 
     // Redirigir al usuario a la página de éxito
     return $this->redirectToRoute('app_landing');
    }
}