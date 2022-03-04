<?php

namespace App\Entity;

use App\Repository\RoomTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomTypeRepository::class)
 */
class RoomType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $beds;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $amenity1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $amenity2;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="type", orphanRemoval=true)
     */
    private $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeds(): ?int
    {
        return $this->beds;
    }

    public function setBeds(int $beds): self
    {
        $this->beds = $beds;

        return $this;
    }

    public function getAmenity1(): ?string
    {
        return $this->amenity1;
    }

    public function setAmenity1(string $amenity1): self
    {
        $this->amenity1 = $amenity1;

        return $this;
    }

    public function getAmenity2(): ?string
    {
        return $this->amenity2;
    }

    public function setAmenity2(string $amenity2): self
    {
        $this->amenity2 = $amenity2;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setType($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getType() === $this) {
                $room->setType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string)$this->beds;
    }
}
