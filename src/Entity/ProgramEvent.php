<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use App\Entity\Review;
use App\Entity\Program;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramEventRepository")
 */
class ProgramEvent
{
    /**
     * Many Events can have many Reviews.
     * @ManyToMany(targetEntity="Review", mappedBy="reviews")
     */
    private $eventReview;

    /**
     * Many Events can have many Programs.
     * @ManyToMany(targetEntity="Program", mappedBy="programs")
     * @JoinTable(name="ProgramEvent",
     *      joinColumns={@JoinColumn(name="review_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="program_id", referencedColumnName="id")},
     *      )
     */
    private $eventPrograms;

    public function __construct()
    {
        $this->eventReview = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventPrograms = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
}
