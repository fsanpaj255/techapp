<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
#[Vich\Uploadable]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $precio = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nombre = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $tamano = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $modelo = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(nullable: true)]
    private ?int $peso = null;


    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'producto', fileNameProperty: 'imageName', size: 'imageSize')]
    private  $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

        // NOTE: This is not a mapped field of entity metadata, just a simple property.
        #[Vich\UploadableField(mapping: 'producto', fileNameProperty: 'imageName2', size: 'imageSize2')]
        private  $imageFile2 = null;
    
        #[ORM\Column(nullable: true)]
        private ?string $imageName2 = null;
    
        #[ORM\Column(nullable: true)]
        private ?int $imageSize2 = null;


            // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'producto', fileNameProperty: 'imageName3', size: 'imageSize3')]
    private  $imageFile3 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName3 = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize3 = null;

    #[Vich\UploadableField(mapping: 'producto', fileNameProperty: 'imageName4', size: 'imageSize4')]
    private  $imageFile4 = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName4 = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize4 = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $categoria = null;

    #[ORM\OneToMany(mappedBy: 'productoid', targetEntity: Oferta::class)]
    private Collection $ofertas;

    public function __construct()
    {
        $this->ofertas = new ArrayCollection();
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getTamano(): ?string
    {   
        return $this->tamano;

    }

    public function setTamano(?string $tamano): self
    {   
        
        $this->tamano = $tamano;
        return $this;

    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(?string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPeso(): ?int
    {
        return $this->peso;
    }

    public function setPeso(?int $peso): self
    {
        $this->peso = $peso;

        return $this;
    }


    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }






    public function setImageFile2(?File $imageFile2 = null): void
    {
        $this->imageFile2 = $imageFile2;

        if (null !== $imageFile2) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile2(): ?File
    {
        return $this->imageFile2;
    }

    public function setImageName2(?string $imageName2): void
    {
        $this->imageName2 = $imageName2;
    }

    public function getImageName2(): ?string
    {
        return $this->imageName2;
    }

    public function setImageSize2(?int $imageSize2): void
    {
        $this->imageSize2 = $imageSize2;
    }

    public function getImageSize2(): ?int
    {
        return $this->imageSize2;
    }





    public function setImageFile3(?File $imageFile3 = null): void
    {
        $this->imageFile3 = $imageFile3;

        if (null !== $imageFile3) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile3(): ?File
    {
        return $this->imageFile3;
    }

    public function setImageName3(?string $imageName3): void
    {
        $this->imageName3 = $imageName3;
    }

    public function getImageName3(): ?string
    {
        return $this->imageName3;
    }

    public function setImageSize3(?int $imageSize3): void
    {
        $this->imageSize3 = $imageSize3;
    }

    public function getImageSize3(): ?int
    {
        return $this->imageSize3;
    }

    public function setImageFile4(?File $imageFile4 = null): void
    {
        $this->imageFile4 = $imageFile4;

        if (null !== $imageFile4) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile4(): ?File
    {
        return $this->imageFile4;
    }

    public function setImageName4(?string $imageName4): void
    {
        $this->imageName4 = $imageName4;
    }

    public function getImageName4(): ?string
    {
        return $this->imageName4;
    }

    public function setImageSize4(?int $imageSize4): void
    {
        $this->imageSize4 = $imageSize4;
    }

    public function getImageSize4(): ?int
    {
        return $this->imageSize4;
    }


    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(?string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return Collection<int, Oferta>
     */
    public function getOfertas(): Collection
    {
        return $this->ofertas;
    }

    public function addOferta(Oferta $oferta): static
    {
        if (!$this->ofertas->contains($oferta)) {
            $this->ofertas->add($oferta);
            $oferta->setProductoid($this);
        }

        return $this;
    }

    public function removeOferta(Oferta $oferta): static
    {
        if ($this->ofertas->removeElement($oferta)) {
            // set the owning side to null (unless already changed)
            if ($oferta->getProductoid() === $this) {
                $oferta->setProductoid(null);
            }
        }

        return $this;
    }
}
