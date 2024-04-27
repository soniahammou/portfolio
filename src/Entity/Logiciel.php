<?php

namespace App\Entity;

use App\Repository\LogicielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogicielRepository::class)]
class Logiciel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;



    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'logiciels')]
    private Collection $projects;

    /**
     * @var Collection<int, Subproject>
     */
    #[ORM\ManyToMany(targetEntity: Subproject::class, mappedBy: 'logiciels')]
    private Collection $subprojects;

 

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->subprojects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

  

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addLogiciel($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            $project->removeLogiciel($this);
        }

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
            $subproject->addLogiciel($this);
        }

        return $this;
    }

    public function removeSubproject(Subproject $subproject): static
    {
        if ($this->subprojects->removeElement($subproject)) {
            $subproject->removeLogiciel($this);
        }

        return $this;
    }


}
