<?php

namespace App\Entity;

use App\Repository\IdeaCategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IdeaCategoryRepository::class)
 */
class IdeaCategory
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
    private $name;

    /**
     * @var IdeaAsk[]
     * @ORM\OneToMany(targetEntity="App\Entity\IdeaAsk", mappedBy="ideaCategory", cascade={"persist"})
     */
    private $ideaAsk;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param IdeaAsk[] $ideaAsk
     * @return IdeaCategory
     */
    public function setIdeaAsk(array $ideaAsk): IdeaCategory
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
}
