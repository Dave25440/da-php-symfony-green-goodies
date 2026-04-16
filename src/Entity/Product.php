<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'name', length: 255)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
    #[Assert\Length(max: 255, maxMessage: 'Le nom ne doit pas dépasser {{ limit }} caractères.')]
    private ?string $name = null;

    #[ORM\Column(name: 'short_description', length: 255)]
    #[Assert\NotBlank(message: 'La description courte est obligatoire.')]
    #[Assert\Length(max: 255, maxMessage: 'La description courte ne doit pas dépasser {{ limit }} caractères.')]
    private ?string $shortDescription = null;

    #[ORM\Column(name: 'full_description', type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Le description longue est obligatoire.')]
    private ?string $fullDescription = null;

    #[ORM\Column(name: 'price')]
    #[Assert\NotNull(message: 'Le prix est obligatoire.')]
    #[Assert\Positive(message: 'Le prix doit être un nombre positif.')]
    private ?float $price = null;

    #[ORM\Column(name: 'picture', length: 255)]
    #[Assert\NotBlank(message: 'La photo est obligatoire.')]
    #[Assert\Length(max: 255, maxMessage: 'Le lien de la photo ne doit pas dépasser {{ limit }} caractères.')]
    #[Assert\Regex(
        pattern: '/\.(jpg|jpeg|png|webp)$/i',
        message: 'La photo doit être au format JPG, JPEG, PNG ou WebP.'
    )]
    private ?string $picture = null;

    #[ORM\Column(name: 'archive', options: ['default' => false])]
    private ?bool $archive = false;

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'product')]
    private Collection $orderItems;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(string $fullDescription): static
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function isArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): static
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setProduct($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getProduct() === $this) {
                $orderItem->setProduct(null);
            }
        }

        return $this;
    }

    public function getPicturePath(): string
    {
        $fullPath = __DIR__ . '/../../public/img/product/' . $this->picture;

        if (!$this->picture || !file_exists($fullPath)) {
            return '/img/product/product-default.webp';
        }

        return '/img/product/' . $this->picture;
    }
}
