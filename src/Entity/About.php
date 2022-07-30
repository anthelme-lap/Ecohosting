<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
class About
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titlemission = null;

    #[ORM\Column(length: 255)]
    private ?string $titlevision = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionmission = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionvision = null;

    #[ORM\Column(length: 255)]
    private ?string $image1 = null;

    #[ORM\Column(length: 255)]
    private ?string $image2 = null;

    #[ORM\Column(length: 255)]
    private ?string $image3 = null;

    #[ORM\Column(length: 255)]
    private ?string $image4 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitlemission(): ?string
    {
        return $this->titlemission;
    }

    public function setTitlemission(string $titlemission): self
    {
        $this->titlemission = $titlemission;

        return $this;
    }

    public function getTitlevision(): ?string
    {
        return $this->titlevision;
    }

    public function setTitlevision(string $titlevision): self
    {
        $this->titlevision = $titlevision;

        return $this;
    }

    public function getDescriptionmission(): ?string
    {
        return $this->descriptionmission;
    }

    public function setDescriptionmission(string $descriptionmission): self
    {
        $this->descriptionmission = $descriptionmission;

        return $this;
    }

    public function getDescriptionvision(): ?string
    {
        return $this->descriptionvision;
    }

    public function setDescriptionvision(string $descriptionvision): self
    {
        $this->descriptionvision = $descriptionvision;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(string $image3): self
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getImage4(): ?string
    {
        return $this->image4;
    }

    public function setImage4(string $image4): self
    {
        $this->image4 = $image4;

        return $this;
    }
}
