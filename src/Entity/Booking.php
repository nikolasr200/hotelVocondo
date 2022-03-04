<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $starting_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ending_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStartingAt(): ?\DateTimeInterface
    {
        return $this->starting_at;
    }

    public function setStartingAt(\DateTimeInterface $starting_at): self
    {
        $this->starting_at = $starting_at;

        return $this;
    }

    public function getEndingAt(): ?\DateTimeInterface
    {
        return $this->ending_at;
    }

    public function setEndingAt(\DateTimeInterface $ending_at): self
    {
        $this->ending_at = $ending_at;

        return $this;
    }
}
