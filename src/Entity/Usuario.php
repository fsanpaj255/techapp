<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[UniqueEntity(fields: ['correo'], message: 'There is already an account with this correo')]
#[UniqueEntity(fields: ['correo'], message: 'There is already an account with this correo')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, nullable: true)]
    private ?string $nickname = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $correo = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tarjeta = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $dni = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $direccion = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $fechaExpiracion;

    #[ORM\Column(type: 'string', length: 3)]
    private ?string $cvv;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $ciudad;

    #[ORM\Column(type: 'string', length: 10)]
    private ?string $codigoPostal;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'usuarioid', targetEntity: Tarjeta::class)]
    private Collection $tarjetaid;

    public function __construct()
    {
        $this->tarjetaid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->correo;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getTarjeta(): ?string
    {
        return $this->tarjeta;
    }

    public function setTarjeta(?string $tarjeta): self
    {
        $this->tarjeta = $tarjeta;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getFechaExpiracion(): ?string
{
    return $this->fechaExpiracion;
}

public function setFechaExpiracion(?string $fechaExpiracion): self
{
    $this->fechaExpiracion = $fechaExpiracion;

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

public function getCiudad(): ?string
{
    return $this->ciudad;
}

public function setCiudad(?string $ciudad): self
{
    $this->ciudad = $ciudad;

    return $this;
}

public function getCodigoPostal(): ?string
{
    return $this->codigoPostal;
}

public function setCodigoPostal(?string $codigoPostal): self
{
    $this->codigoPostal = $codigoPostal;

    return $this;
}

/**
 * @return Collection<int, Tarjeta>
 */
public function getTarjetaid(): Collection
{
    return $this->tarjetaid;
}

public function addTarjetaid(Tarjeta $tarjetaid): self
{
    if (!$this->tarjetaid->contains($tarjetaid)) {
        $this->tarjetaid->add($tarjetaid);
        $tarjetaid->setUsuarioid($this);
    }

    return $this;
}

public function removeTarjetaid(Tarjeta $tarjetaid): self
{
    if ($this->tarjetaid->removeElement($tarjetaid)) {
        // set the owning side to null (unless already changed)
        if ($tarjetaid->getUsuarioid() === $this) {
            $tarjetaid->setUsuarioid(null);
        }
    }

    return $this;
}

}
