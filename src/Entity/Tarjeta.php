<?php

namespace App\Entity;

use App\Repository\TarjetaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TarjetaRepository::class)]
class Tarjeta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $numerotarjeta = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaexpiracion = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $cvv = null;

    #[ORM\ManyToOne(inversedBy: 'tarjetaid')]
    private ?Usuario $usuarioid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerotarjeta(): ?string
    {
        return $this->numerotarjeta;
    }

    public function setNumerotarjeta(?string $numerotarjeta): self
    {
        $this->numerotarjeta = $numerotarjeta;

        return $this;
    }

    public function getFechaexpiracion(): ?\DateTimeInterface
    {
        return $this->fechaexpiracion;
    }

    public function setFechaexpiracion(?\DateTimeInterface $fechaexpiracion): self
    {
        $this->fechaexpiracion = $fechaexpiracion;

        return $this;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(?string $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
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
}
