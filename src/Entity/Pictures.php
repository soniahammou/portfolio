<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PicturesRepository::class)]
class Pictures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $subproject = null;

    #[ORM\Column(length: 400)]
    private ?string $projectLogo = null;

    /**
     * @var Collection<int, Subproject>
     */
    #[ORM\ManyToMany(targetEntity: Subproject::class, inversedBy: 'pictures')]
    private Collection $pictures;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubproject(): ?string
    {
        return $this->subproject;
    }

    public function setSubproject(string $subproject): static
    {
        $this->subproject = $subproject;

        return $this;
    }

    public function getProjectLogo(): ?string
    {
        return $this->projectLogo;
    }

    public function setProjectLogo(string $projectLogo): static
    {
        $this->projectLogo = $projectLogo;

        return $this;
    }

    /**
     * @return Collection<int, Subproject>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Subproject $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
        }

        return $this;
    }

    public function removePicture(Subproject $picture): static
    {
        $this->pictures->removeElement($picture);

        return $this;
    }
}
