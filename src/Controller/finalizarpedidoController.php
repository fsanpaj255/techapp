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
use Symfony\Component\HttpFoundation\RedirectResponse;
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
 
 
    // Crear un nuevo pedido
    $pedido = new Pedido();
    $pedido->setUsuarioidpedido($usuario);
    $pedido->setProductoscomprados($productos);

    // Guardar el pedido en la base de datos
    $entityManager->persist($pedido);
    $entityManager->flush();

    // Le añadimos un true por parametro a la url para que con el jquery detecte el true y muestre el moidal
    return new RedirectResponse($this->generateUrl('app_landing', ['modal' => 'true']));
    }
}