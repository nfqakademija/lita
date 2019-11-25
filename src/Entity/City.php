<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ProgramEvent;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
{
    /**
     * One City has many Events. This is the inverse side.
     * @OneToMany(targetEntity="ProgramEvent", mappedBy="cities", cascade={"remove"})
     */
    private $events;

    /**
     * Many Cities have one Academy. This is the owning side.
     * @ManyToOne(targetEntity="Academy", inversedBy="cities")
     * @JoinColumn(name="academy_id", referencedColumnName="id")
     */
    private $academy;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->city;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city_address;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function setCityAddress(string $city_address): ?string
    {
        $this->city_address = $city_address;
        return $this;
    }

    public function getCityAddress(): ?string
    {
        return $this->city_address;
    }

    /**
     * @return Collection
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    /**
     * @param ArrayCollection $events
     */
    public function setEvents(ArrayCollection $events): void
    {
        $this->events = $events;
    }

    /**
     * @return mixed
     */
    public function getAcademy()
    {
        return $this->academy;
    }

    /**
     * @param mixed $academy
     */
    public function setAcademy($academy): void
    {
        $this->academy = $academy;
    }
}
