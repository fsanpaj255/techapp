<?php

namespace App\Entity;

use App\Repository\OfertaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfertaRepository::class)]
class Oferta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $f_inicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $f_fin = null;

    #[ORM\Column(nullable: true)]
    private ?int $descuento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFInicio(): ?\DateTimeInterface
    {
        return $this->f_inicio;
    }

    public function setFInicio(?\DateTimeInterface $f_inicio): self
    {
        $this->f_inicio = $f_inicio;

        return $this;
    }

    public function getFFin(): ?\DateTimeInterface
    {
        return $this->f_fin;
    }

    public function setFFin(?\DateTimeInterface $f_fin): self
    {
        $this->f_fin = $f_fin;

        return $this;
    }

    public function getDescuento(): ?int
    {
        return $this->descuento;
    }

    public function setDescuento(?int $descuento): self
    {
        $this->descuento = $descuento;

        return $this;
    }
}
