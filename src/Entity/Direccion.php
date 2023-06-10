<?php

namespace App\Entity;

use App\Repository\DireccionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DireccionRepository::class)]
class Direccion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $calle = null;

    #[ORM\Column]
    private ?int $codigopostal = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ciudad = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $provincia = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $pais = null;

    #[ORM\ManyToOne(inversedBy: 'direccionid')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuarioid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(?string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getCodigopostal(): ?int
    {
        return $this->codigopostal;
    }

    public function setCodigopostal(int $codigopostal): self
    {
        $this->codigopostal = $codigopostal;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(?string $ciudad): self
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(?string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): self
    {
        $this->pais = $pais;

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
