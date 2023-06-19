<?php

namespace App\Controller;

use App\Entity\Producto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\DescuentoType;

class OfertaController extends AbstractController
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/aplicardescuento/{id}', name: 'app_descuento', methods: ['GET', 'POST'])]
    public function cargarFormularioDescuento(Request $request, int $id)
    {
        $producto = $this->entityManager->getRepository(Producto::class)->find($id);
    
 
        $formulario = $this->createForm(DescuentoType::class);
        $formulario->handleRequest($request);
    
        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $porcentaje = $formulario->get('porcentaje')->getData();
    
            // Actualiza el precio del producto aplicando el descuento en ofertas
            $precio = $producto->getPrecio();
            $nuevoPrecio = $precio - ($precio * $porcentaje / 100);
            $producto->setPreciooferta($nuevoPrecio);
    
            // Guarda el producto actualizado en la base de datos
            $this->entityManager->flush();
            return new RedirectResponse($this->generateUrl('app_producto_index', ['id' => $id]));
        }
    
        return $this->render('producto/oferta.html.twig', [
            'formulario' => $formulario->createView(),
        ]);
    }
}