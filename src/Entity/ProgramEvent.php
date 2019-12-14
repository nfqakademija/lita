<?php

namespace App\Entity;

use DateTimeInterface;
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
     * @var string
     */
    private $cities;

    /**
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="Program", inversedBy="program_events")
     * @JoinColumn(name="program_id", referencedColumnName="id")
     * @var string
     */
    private $programs;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @var DateTimeInterface|null
     */
    private $program_start;

    /**
     * @ORM\Column(type="date")
     * @var DateTimeInterface|null
     */
    private $program_end;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $program_location;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $program_address;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getProgramStart(): ?DateTimeInterface
    {
        return $this->program_start;
    }

    /**
     * @param DateTimeInterface|null $program_start
     */
    public function setProgramStart(?DateTimeInterface $program_start): void
    {
        $this->program_start = $program_start;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getProgramEnd(): ?DateTimeInterface
    {
        return $this->program_end;
    }

    /**
     * @param DateTimeInterface|null $program_end
     */
    public function setProgramEnd(?DateTimeInterface $program_end): void
    {
        $this->program_end = $program_end;
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
