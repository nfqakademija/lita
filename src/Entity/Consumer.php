<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsumerRepository")
 */
class Consumer
{
    /**
     * One Consumer can leave Review. This is the inverse side.
     * @OneToMany(targetEntity="Review", mappedBy="consumer", cascade={"remove"})
     */
    private $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->consumer_name;
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
    private $consumer_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $consumer_lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $consumer_email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $consumer_password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConsumerName(): ?string
    {
        return $this->consumer_name;
    }

    public function setConsumerName(string $consumer_name): self
    {
        $this->consumer_name = $consumer_name;

        return $this;
    }

    public function getConsumerLastname(): ?string
    {
        return $this->consumer_lastname;
    }

    public function setConsumerLastname(string $consumer_lastname): self
    {
        $this->consumer_lastname = $consumer_lastname;

        return $this;
    }

    public function getConsumerEmail(): ?string
    {
        return $this->consumer_email;
    }

    public function setConsumerEmail(string $consumer_email): self
    {
        $this->consumer_email = $consumer_email;

        return $this;
    }

    public function getConsumerPassword(): ?string
    {
        return $this->consumer_password;
    }

    public function setConsumerPassword(string $consumer_password): self
    {
        $this->consumer_password = $consumer_password;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    /**
     * @param ArrayCollection $reviews
     */
    public function setReviews(ArrayCollection $reviews): void
    {
        $this->reviews = $reviews;
    }
}
