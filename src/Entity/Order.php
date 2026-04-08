<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'date')]
    #[Assert\NotBlank(message: 'La date est obligatoire.')]
    #[Assert\LessThanOrEqual(
        'today',
        message: 'La date ne doit pas être postérieure à aujourd\'hui.'
    )]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(name: 'total')]
    #[Assert\NotNull(message: 'Le prix total est obligatoire.')]
    #[Assert\Positive(message: 'Le prix total doit être un nombre positif.')]
    private ?float $total = null;

    #[ORM\Column(name: 'status', length: 255)]
    #[Assert\NotBlank(message: 'Le statut est obligatoire.')]
    #[Assert\Choice(
        choices: ['En cours', 'Traitée', 'Annulée'],
        message: 'Le statut {{ value }} est invalide.'
    )]
    private string $status = 'Traitée';

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'purchase', orphanRemoval: true)]
    private Collection $orderItems;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(name: 'user_id', nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
            $orderItem->setPurchase($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getPurchase() === $this) {
                $orderItem->setPurchase(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
