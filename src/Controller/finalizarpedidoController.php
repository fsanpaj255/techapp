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
 
     // Decodificamos los Json
     $productos = json_decode($productosJson, true);
 
     // Obtener el usuario
     $usuario =   $usuario = $this->getUser();
 
 
          $pedido = new Pedido();

          // id del suaurio idusuario de pedido
         $pedido->setUsuarioid($usuario);
                
     // Productos como array de productos comprados
      $pedido->setProductoscomprados($productos);
                
     $entityManager->persist($pedido);
     $entityManager->flush();
 
     return $this->redirectToRoute('app_landing');
    }
}