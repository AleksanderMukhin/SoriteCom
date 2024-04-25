<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuRepository::class)]
class Lieu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $l_nom = null;

    #[ORM\Column(length: 100)]
    private ?string $l_rue = null;

    #[ORM\Column(nullable: true)]
    private ?float $l_latitude = null;

    #[ORM\Column(nullable: true)]
    private ?float $l_longitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLNom(): ?string
    {
        return $this->l_nom;
    }

    public function setLNom(string $l_nom): static
    {
        $this->l_nom = $l_nom;

        return $this;
    }

    public function getLRue(): ?string
    {
        return $this->l_rue;
    }

    public function setLRue(string $l_rue): static
    {
        $this->l_rue = $l_rue;

        return $this;
    }

    public function getLLatitude(): ?float
    {
        return $this->l_latitude;
    }

    public function setLLatitude(?float $l_latitude): static
    {
        $this->l_latitude = $l_latitude;

        return $this;
    }

    public function getLLongitude(): ?float
    {
        return $this->l_longitude;
    }

    public function setLLongitude(?float $l_longitude): static
    {
        $this->l_longitude = $l_longitude;

        return $this;
    }
}
