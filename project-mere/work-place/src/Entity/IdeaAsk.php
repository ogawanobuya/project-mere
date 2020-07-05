<?php

namespace App\Entity;

use App\Repository\IdeaAskRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IdeaAskRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class IdeaAsk
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSolved;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ideaAsk", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IdeaCategory", inversedBy="ideaAsk", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idea_category_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $ideaCategory;

    /**
     * @var IdeaAnswer[]
     * @ORM\OneToMany(targetEntity="App\Entity\IdeaAnswer", mappedBy="ideaAsk", cascade={"persist"})
     */
    private $ideaAnswer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsSolved(): ?bool
    {
        return $this->isSolved;
    }

    public function setIsSolved(?bool $isSolved): self
    {
        $this->isSolved = $isSolved;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIdeaCategory(): ?IdeaCategory
    {
        return $this->ideaCategory;
    }

    public function setIdeaCategory(?IdeaCategory $ideaCategory): self
    {
        $this->ideaCategory = $ideaCategory;

        return $this;
    }

    /**
     * @param IdeaAnswer[] $ideaAnswer
     * @return IdeaAsk
     */
    public function setIdeaAnswer(array $ideaAnswer): IdeaAsk
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
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
