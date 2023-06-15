<?php

namespace App\Controller;

use App\Entity\Pedido;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MiPerfilController extends AbstractController
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/miperfil', name: 'app_miperfil')]
    public function index(): Response
    {
        $usuario = $this->getUser();
        
        $pedidos = $this->entityManager->getRepository(Pedido::class)->createQueryBuilder('p')
            ->where('p.usuarioidpedido = :usuario')
            ->setParameter('usuario', $usuario)
            ->getQuery()
            ->getResult();
        
        return $this->render('perfilusuario/index.html.twig', [
            'usuario' => $usuario,
            'pedidos' => $pedidos,
        ]);
    }
}
