<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TripRepository::class)]
class Trip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $destination = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $characteristics = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 100)]
    private ?string $host = null;

    #[ORM\ManyToMany(targetEntity: Item::class)]
    private Collection $tripItem;

    #[ORM\Column(length: 255)]
    private ?string $award = null;

    #[ORM\OneToMany(mappedBy: 'trip', targetEntity: SelectedTrip::class, cascade: ['persist'])]
    private Collection $selectedTrips;

    public function __construct()
    {
        $this->tripItem = new ArrayCollection();
        $this->selectedTrips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCharacteristics(): ?string
    {
        return $this->characteristics;
    }

    public function setCharacteristics(string $characteristics): self
    {
        $this->characteristics = $characteristics;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getTripItem(): Collection
    {
        return $this->tripItem;
    }

    public function addTripItem(Item $tripItem): self
    {
        if (!$this->tripItem->contains($tripItem)) {
            $this->tripItem->add($tripItem);
        }

        return $this;
    }

    public function removeTripItem(Item $tripItem): self
    {
        $this->tripItem->removeElement($tripItem);

        return $this;
    }

    public function getAward(): ?string
    {
        return $this->award;
    }

    public function setAward(string $award): self
    {
        $this->award = $award;

        return $this;
    }


    /**
     * @return Collection<int, SelectedTrip>
     */
    public function getSelectedTrips(): Collection
    {
        return $this->selectedTrips;
    }

    public function addSelectedTrip(SelectedTrip $selectedTrip): self
    {
        if (!$this->selectedTrips->contains($selectedTrip)) {
            $this->selectedTrips->add($selectedTrip);
            $selectedTrip->setTrip($this);
        }

        return $this;
    }

    public function removeSelectedTrip(SelectedTrip $selectedTrip): self
    {
        if ($this->selectedTrips->removeElement($selectedTrip)) {
            // set the owning side to null (unless already changed)
            if ($selectedTrip->getTrip() === $this) {
                $selectedTrip->setTrip(null);
            }
        }

        return $this;
    }
}
