<?php

namespace App\Entity;

use App\Repository\RankRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RankRepository::class)
 */
class Rank
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
    private $niveux;

    /**
     * @ORM\OneToMany(targetEntity=Matche::class, mappedBy="niveuxMatch")
     */
    private $matches;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveux(): ?string
    {
        return $this->niveux;
    }

    public function setNiveux(string $niveux): self
    {
        $this->niveux = $niveux;

        return $this;
    }

    /**
     * @return Collection|Matche[]
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(Matche $match): self
    {
        if (!$this->matches->contains($match)) {
            $this->matches[] = $match;
            $match->setNiveuxMatch($this);
        }

        return $this;
    }

    public function removeMatch(Matche $match): self
    {
        if ($this->matches->contains($match)) {
            $this->matches->removeElement($match);
            // set the owning side to null (unless already changed)
            if ($match->getNiveuxMatch() === $this) {
                $match->setNiveuxMatch(null);
            }
        }

        return $this;
    }
}
