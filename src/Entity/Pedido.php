<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoRepository::class)]
class Pedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private array $productoscomprados = [];

    #[ORM\ManyToOne(inversedBy: 'pedidoid')]
    private ?Usuario $usuarioidpedido = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductoscomprados(): array
    {
        return $this->productoscomprados;
    }

    public function setProductoscomprados(?array $productoscomprados): self
    {
        $this->productoscomprados = $productoscomprados;

        return $this;
    }

    public function getUsuarioidpedido(): ?Usuario
    {
        return $this->usuarioidpedido;
    }

    public function setUsuarioidpedido(?Usuario $usuarioidpedido): self
    {
        $this->usuarioidpedido = $usuarioidpedido;

        return $this;
    }
}
