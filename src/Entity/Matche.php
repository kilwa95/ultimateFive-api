<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MatcheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MatcheRepository::class)
 */
class Matche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visibility;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="matches")
     */
    private $salle;

    /**
     * @ORM\ManyToOne(targetEntity=TypeMatche::class, inversedBy="matches")
     */
    private $typeMatch;

    /**
     * @ORM\ManyToOne(targetEntity=Rank::class, inversedBy="matches")
     */
    private $niveuxMatch;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="matche")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateMatche;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $horaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisibility(): ?bool
    {
        return $this->visibility;
    }

    public function setVisibility(bool $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    public function getTypeMatch(): ?TypeMatche
    {
        return $this->typeMatch;
    }

    public function setTypeMatch(?TypeMatche $typeMatch): self
    {
        $this->typeMatch = $typeMatch;

        return $this;
    }

    public function getNiveuxMatch(): ?Rank
    {
        return $this->niveuxMatch;
    }

    public function setNiveuxMatch(?Rank $niveuxMatch): self
    {
        $this->niveuxMatch = $niveuxMatch;

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

    public function getDateMatche(): ?\DateTimeInterface
    {
        return $this->dateMatche;
    }

    public function setDateMatche(\DateTimeInterface $dateMatche): self
    {
        $this->dateMatche = $dateMatche;

        return $this;
    }

    public function getHoraire(): ?string
    {
        return $this->horaire;
    }

    public function setHoraire(string $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }
}
