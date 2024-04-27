<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $summary = null;
    
    #[ORM\Column(length: 500)]
    private ?string $picture = null;

    #[ORM\Column]
    private ?int $home_order = null;

    /**
     * @var Collection<int, Logiciel>
     */
    #[ORM\ManyToMany(targetEntity: Logiciel::class, inversedBy: 'projects')]
    private Collection $logiciels;

    /**
     * @var Collection<int, Subproject>
     */
    #[ORM\OneToMany(targetEntity: Subproject::class, mappedBy: 'project')]
    private Collection $subprojects;

    /**
     * @var Collection<int, Tags>
     */
    #[ORM\ManyToMany(targetEntity: Tags::class, inversedBy: 'projects')]
    private Collection $tags;

 
    public function __construct()
    {
        $this->logiciels = new ArrayCollection();
        $this->subprojects = new ArrayCollection();
        $this->tags = new ArrayCollection();
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

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

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

    /**
     * @return Collection<int, Subproject>
     */
    public function getSubprojects(): Collection
    {
        return $this->subprojects;
    }

    public function addSubproject(Subproject $subproject): static
    {
        if (!$this->subprojects->contains($subproject)) {
            $this->subprojects->add($subproject);
            $subproject->setProject($this);
        }

        return $this;
    }

    public function removeSubproject(Subproject $subproject): static
    {
        if ($this->subprojects->removeElement($subproject)) {
            // set the owning side to null (unless already changed)
            if ($subproject->getProject() === $this) {
                $subproject->setProject(null);
            }
        }

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

    public function getHomeOrder(): ?int
    {
        return $this->home_order;
    }

    public function setHomeOrder(int $home_order): static
    {
        $this->home_order = $home_order;

        return $this;
    }

    /**
     * @return Collection<int, Tags>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tags $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }
}
