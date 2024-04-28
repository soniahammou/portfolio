<?php

namespace App\Entity;

use App\Repository\ImageSubprojectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageSubprojectRepository::class)]
class ImageSubproject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 400)]
    private ?string $picture = null;

    /**
     * @var Collection<int, Subproject>
     */
    #[ORM\ManyToMany(targetEntity: Subproject::class, inversedBy: 'imageSubprojects')]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Subproject>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Subproject $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
        }

        return $this;
    }

    public function removeImage(Subproject $image): static
    {
        $this->images->removeElement($image);

        return $this;
    }
}
