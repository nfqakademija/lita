<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Entity\Academy;
use App\Entity\ProgramEvent;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramRepository")
 */
class Program
{
    /**
     * One Program has many Events. This is the inverse side.
     * @OneToMany(targetEntity="ProgramEvent", mappedBy="programs")
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgramName(): ?string
    {
        return $this->program_name;
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
}
