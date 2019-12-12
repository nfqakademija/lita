<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{

    public function __toString()
    {
        return $this->review_stars;
    }

    /**
     * Many Reviews have one Consumer. This is the owning side.
     * @ManyToOne(targetEntity="Consumer", inversedBy="reviews")
     * @JoinColumn(name="consumer_id", referencedColumnName="id")
     */
    private $consumer;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $review_stars;

    /**
     * @ORM\Column(type="text")
     */
    private $review_comment;

    /**
     * @ORM\Column(type="date")
     */
    private $review_data;

    /**
     * @var Program
     * Many Reviews have one Consumer. This is the owning side.
     * @ManyToOne(targetEntity="Program", inversedBy="reviews")
     * @JoinColumn(name="program_id", referencedColumnName="id")
     */
    private $program;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReviewStars(): ?string
    {
        return $this->review_stars;
    }

    public function setReviewStars(string $review_stars): self
    {
        $this->review_stars = $review_stars;

        return $this;
    }

    public function getReviewComment(): ?string
    {
        return $this->review_comment;
    }

    public function setReviewComment(string $review_comment): self
    {
        $this->review_comment = $review_comment;

        return $this;
    }

    public function getReviewData(): ?\DateTimeInterface
    {
        return $this->review_data;
    }

    public function setReviewData(\DateTimeInterface $review_data): self
    {
        $this->review_data = $review_data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConsumer()
    {
        return $this->consumer;
    }

    /**
     * @param mixed $consumer
     */
    public function setConsumer($consumer): void
    {
        $this->consumer = $consumer;
    }

    /**
     * @return mixed
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * @param Program $program
     */
    public function setProgram(Program $program): void
    {
        $this->program = $program;
    }
}
