<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsumerRepository")
 */
class Consumer implements UserInterface
{
    /**
     * One Consumer can leave Review. This is the inverse side.
     * @OneToMany(targetEntity="Review", mappedBy="consumer", cascade={"remove"})
     * @var mixed
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
     * @var int
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $consumer_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $consumer_lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $consumer_email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $consumer_password;

    /**
     * @ORM\Column(type="json")
     * @var mixed
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $googleId;

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

    /**
     * @return mixed
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * @param mixed $googleId
     */
    public function setGoogleId($googleId): void
    {
        $this->googleId = $googleId;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->consumer_name;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->consumer_password;
    }

    public function setPassword(string $password): self
    {
        $this->consumer_password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
