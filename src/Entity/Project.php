<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]

class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\Length(
        min: 5,
        max: 300,
    )]
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    #[Assert\Regex('/^\w+/')]
    private ?string $summary = null;
    
    #[ORM\Column(length: 500)]
    private ?string $picture = null;

    // // #[Assert\Image()]
    // //mapping : defini dans vich_uplader.yaml / fileNameProperty : lros de la sauvegarde su fichier ilva recup les informations,n dans quel propriete on sauvegarde le fichier
    // #[Vich\UploadableField(mapping: 'fileNames', fileNameProperty: 'picture')]
    // private ?File $pictureFile = null;


    /**
     * @var Collection<int, Logiciel>
     */
    #[Assert\NotBlank]
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
    #[Assert\NotBlank]
    #[ORM\ManyToMany(targetEntity: Tags::class, inversedBy: 'projects')]
    private Collection $tags;

    #[ORM\Column]
    // #[Assert\DateTime]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    // #[Assert\DateTime]
    private ?\DateTimeImmutable $updated_at = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 100)]
    private ?string $status = null;
    


 
    public function __construct()
    {
        $this->logiciels = new ArrayCollection();
        $this->subprojects = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }



}
