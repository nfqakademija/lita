<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\OneToMany;
use App\Entity\Program;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AcademyRepository")
 */
class Academy
{
    /**
     * One Academy has many Programs. This is the inverse side.
     * @OneToMany(targetEntity="Program", mappedBy="program")
     */
    private $programs;

    public function __construct()
    {
        $this->programs = new ArrayCollection();
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
    private $academy_name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcademyName(): ?string
    {
        return $this->academy_name;
    }

    public function setAcademyName(string $academy_name): self
    {
        $this->academy_name = $academy_name;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPrograms(): ArrayCollection
    {
        return $this->programs;
    }

    /**
     * @param ArrayCollection $programs
     */
    public function setPrograms(ArrayCollection $programs): void
    {
        $this->programs = $programs;
    }








}
