<?php

namespace App\Entity;

use App\Repository\OfertaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfertaRepository::class)]
class Oferta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ofertas')]
    private ?Producto $productoid = null;

    #[ORM\Column(nullable: true)]
    private ?int $porcentaje = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductoid(): ?Producto
    {
        return $this->productoid;
    }

    public function setProductoid(?Producto $productoid): static
    {
        $this->productoid = $productoid;

        return $this;
    }

    public function getPorcentaje(): ?int
    {
        return $this->porcentaje;
    }

    public function setPorcentaje(?int $porcentaje): static
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }
}
