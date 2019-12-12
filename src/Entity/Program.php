<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramRepository")
 * @Table(indexes={@Index(name="idx_program_name", columns={"program_name"})})
 */
class Program
{
    /**
     * One Program has many Events. This is the inverse side.
     * @OneToMany(targetEntity="ProgramEvent", mappedBy="programs", cascade={"remove"})
     */
    private $events;

    /**
     * One Review has many Events. This is the inverse side.
     * @OneToMany(targetEntity="Review", mappedBy="program", cascade={"remove"})
     */
    private $reviews;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->program_name;
    }

    /**
     * Many Programs have one Academy. This is the owning side.
     * @ManyToOne(targetEntity="Academy", inversedBy="programs")
     * @JoinColumn(name="academy_id", referencedColumnName="id")
     */
    private $academy;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $program_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $program_url;

    /**
     * @ORM\Column(type="integer", length=100, nullable=true)
     */
    private $program_price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgramName(): ?string
    {
        return $this->program_name;
    }

    public function getProgramPrice(): ?int
    {
        return $this->program_price;
    }

    public function setProgramPrice(int $program_price): self
    {
        $this->program_price = $program_price;
        return $this;
    }

    public function setProgramName(string $program_name): self
    {
        $this->program_name = $program_name;

        return $this;
    }

    public function getProgramUrl(): ?string
    {
        return $this->program_url;
    }

    public function setProgramUrl(string $program_url): self
    {
        $this->program_url = $program_url;

        return $this;
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

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews): void
    {
        $this->reviews = $reviews;
    }
}
