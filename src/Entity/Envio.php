<?php

namespace App\Entity;

use App\Repository\EnvioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnvioRepository::class)]
class Envio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $kms = null;

    #[ORM\Column(nullable: true)]
    private ?bool $minimo = null;

    #[ORM\Column(nullable: true)]
    private ?int $precio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaestimada = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKms(): ?int
    {
        return $this->kms;
    }

    public function setKms(?int $kms): self
    {
        $this->kms = $kms;

        return $this;
    }

    public function isMinimo(): ?bool
    {
        return $this->minimo;
    }

    public function setMinimo(?bool $minimo): self
    {
        $this->minimo = $minimo;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(?int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getFechaestimada(): ?\DateTimeInterface
    {
        return $this->fechaestimada;
    }

    public function setFechaestimada(?\DateTimeInterface $fechaestimada): self
    {
        $this->fechaestimada = $fechaestimada;

        return $this;
    }
}
