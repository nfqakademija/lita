<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramEventRepository")
 */
class ProgramEvent
{
    public function __toString()
    {
        return $this->program_location;
    }
    /**
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="City", inversedBy="program_events", cascade={"remove"})
     * @JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $cities;

    /**
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="Program", inversedBy="program_events")
     * @JoinColumn(name="program_id", referencedColumnName="id")
     */
    private $programs;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $program_start;

    /**
     * @ORM\Column(type="date")
     */
    private $program_end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $program_location;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $program_address;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgramStart(): ?\DateTimeInterface
    {
        return $this->program_start;
    }

    public function setProgramStart(\DateTimeInterface $program_start): self
    {
        $this->program_start = $program_start;

        return $this;
    }

    public function getProgramEnd(): ?\DateTimeInterface
    {
        return $this->program_end;
    }

    public function setProgramEnd(\DateTimeInterface $program_end): self
    {
        $this->program_end = $program_end;

        return $this;
    }

    public function getProgramLocation(): ?string
    {
        return $this->program_location;
    }

    public function setProgramLocation(string $program_location): self
    {
        $this->program_location = $program_location;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * @param mixed $cities
     */
    public function setCities($cities): void
    {
        $this->cities = $cities;
    }

    public function setProgramAddress(string $program_address): ?string
    {
        $this->program_address = $program_address;
        return $this;
    }

    public function getProgramAddress(): ?string
    {
        return $this->program_address;
    }

    /**
     * @return mixed
     */
    public function getPrograms()
    {
        return $this->programs;
    }

    /**
     * @param mixed $programs
     */
    public function setPrograms($programs): void
    {
        $this->programs = $programs;
    }
}
