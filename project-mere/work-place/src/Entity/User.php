<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("userEmail")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface, Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     */
    private $userEmail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $profile;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPermitEmail;

    /**
     * @var $ideaAsk[]
     * @ORM\OneToMany(targetEntity="App\Entity\IdeaAsk", mappedBy="user", cascade={"persist"})
     */
    private $ideaAsk;

    /**
     * @var IdeaAnswer[]
     * @ORM\OneToMany(targetEntity="App\Entity\IdeaAnswer", mappedBy="user", cascade={"persist"})
     */
    private $ideaAnswer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->isActive = true;
        $this->isPermitEmail = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): self
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getProfile(): ?string
    {
        return $this->profile;
    }

    public function setProfile(?string $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsPermitEmail(): ?bool
    {
        return $this->isPermitEmail;
    }

    public function setIsPermitEmail(bool $isPermitEmail): self
    {
        $this->isPermitEmail = $isPermitEmail;

        return $this;
    }

    /**
     * @param IdeaAsk[] $ideaAsk
     * @return User
     */
    public function setIdeaAsk(array $ideaAsk): self
    {
        $this->ideaAsk = $ideaAsk;
        return $this;
    }

    /**
     * @return Collection|IdeaAsk[]
     */
    public function getIdeaAsk(): Collection
    {
        return $this->ideaAsk;
    }

    /**
     * @param IdeaAnswer[] $ideaAnswer
     * @return User
     */
    public function setIdeaAnswer(array $ideaAnswer): self
    {
        $this->ideaAnswer = $ideaAnswer;
        return $this;
    }

    /**
     * @return Collection|IdeaAnswer[]
     */
    public function getIdeaAnswer(): Collection
    {
        return $this->ideaAnswer;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
        return null;
    }

    public function getRoles()
    {
        if($this->userEmail == 'pigretyasushi@gmail.com'){
            return array('ROLE_ADMIN');
        }else{
            return array('ROLE_USER');
        }
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->userEmail,
            $this->password,
            $this->username,
            $this->profile,
            $this->isActive,
            $this->isPermitEmail,
        ));
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->userEmail,
            $this->password,
            $this->username,
            $this->profile,
            $this->isActive,
            $this->isPermitEmail,
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $now = new \DateTime();
        $this->createdAt = $now;
    }
}
