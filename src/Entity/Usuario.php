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

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $dni = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'usuarioid', targetEntity: Tarjeta::class)]
    private Collection $tarjetaid;

    #[ORM\OneToMany(mappedBy: 'usuarioid', targetEntity: Direccion::class)]
    private Collection $direccionid;

    #[ORM\OneToMany(mappedBy: 'usuarioidpedido', targetEntity: Pedido::class)]
    private Collection $pedidoid;

    public function __construct()
    {
        $this->tarjetaid = new ArrayCollection();
        $this->direccionid = new ArrayCollection();
        $this->pedidoid = new ArrayCollection();
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


    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): self
    {
        $this->dni = $dni;

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

/**
 * @return Collection<int, Direccion>
 */
public function getDireccionid(): Collection
{
    return $this->direccionid;
}

public function addDireccionid(Direccion $direccionid): self
{
    if (!$this->direccionid->contains($direccionid)) {
        $this->direccionid->add($direccionid);
        $direccionid->setUsuarioid($this);
    }

    return $this;
}

public function removeDireccionid(Direccion $direccionid): self
{
    if ($this->direccionid->removeElement($direccionid)) {
        // set the owning side to null (unless already changed)
        if ($direccionid->getUsuarioid() === $this) {
            $direccionid->setUsuarioid(null);
        }
    }

    return $this;
}

/**
 * @return Collection<int, Pedido>
 */
public function getPedidoid(): Collection
{
    return $this->pedidoid;
}

public function addPedidoid(Pedido $pedidoid): self
{
    if (!$this->pedidoid->contains($pedidoid)) {
        $this->pedidoid->add($pedidoid);
        $pedidoid->setUsuarioidpedido($this);
    }

    return $this;
}

public function removePedidoid(Pedido $pedidoid): self
{
    if ($this->pedidoid->removeElement($pedidoid)) {
        // set the owning side to null (unless already changed)
        if ($pedidoid->getUsuarioidpedido() === $this) {
            $pedidoid->setUsuarioidpedido(null);
        }
    }

    return $this;
}

}
