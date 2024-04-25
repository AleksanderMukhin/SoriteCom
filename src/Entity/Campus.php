<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampusRepository::class)]
class Campus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $c_nom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCNom(): ?string
    {
        return $this->c_nom;
    }

    public function setCNom(string $c_nom): static
    {
        $this->c_nom = $c_nom;

        return $this;
    }
}
