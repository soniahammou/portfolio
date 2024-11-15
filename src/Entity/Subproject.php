<?php

namespace App\Entity;

use App\Repository\SubprojectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SubprojectRepository::class)]
class Subproject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Regex('/^\w+/')]
    private ?string $summary = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 3000, nullable: true)]
    private ?string $content = null;

    #[Assert\NotBlank]
    #[ORM\ManyToOne(inversedBy: 'subprojects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    /**
     * @var Collection<int, Logiciel>
     */
    #[ORM\ManyToMany(targetEntity: Logiciel::class, inversedBy: 'subprojects')]
    private Collection $logiciels;

    /**
     * @var Collection<int, Pictures>
     */
    #[ORM\ManyToMany(targetEntity: Pictures::class, mappedBy: 'pictures')]
    private Collection $pictures;

    #[ORM\Column(length: 100)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

   

    public function __construct()
    {
        $this->logiciels = new ArrayCollection();
        $this->pictures = new ArrayCollection();
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

    /**
     * @return Collection<int, Pictures>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->addPicture($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            $picture->removePicture($this);
        }

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


  


}
