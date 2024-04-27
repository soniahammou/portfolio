<?php

namespace App\Entity;

use App\Repository\SubprojectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubprojectRepository::class)]
class Subproject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $summary = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle = null;

    #[ORM\Column(length: 3000, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(length: 400)]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'subprojects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    /**
     * @var Collection<int, Logiciel>
     */
    #[ORM\ManyToMany(targetEntity: Logiciel::class, inversedBy: 'subprojects')]
    private Collection $logiciels;

    public function __construct()
    {
        $this->logiciels = new ArrayCollection();
    }

 
  


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): static
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection<int, Logiciel>
     */
    public function getLogiciels(): Collection
    {
        return $this->logiciels;
    }

    public function addLogiciel(Logiciel $logiciel): static
    {
        if (!$this->logiciels->contains($logiciel)) {
            $this->logiciels->add($logiciel);
        }

        return $this;
    }

    public function removeLogiciel(Logiciel $logiciel): static
    {
        $this->logiciels->removeElement($logiciel);

        return $this;
    }

  


}
