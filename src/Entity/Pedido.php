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

    #[ORM\ManyToOne]
    private ?Usuario $usuarioid = null;

    #[ORM\Column(nullable: true)]
    private array $productoscomprados = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuarioid(): ?Usuario
    {
        return $this->usuarioid;
    }

    public function setUsuarioid(?Usuario $usuarioid): self
    {
        $this->usuarioid = $usuarioid;

        return $this;
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
}
