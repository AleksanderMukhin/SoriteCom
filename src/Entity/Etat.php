<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatRepository::class)]
class Etat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $e_libelle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getELibelle(): ?string
    {
        return $this->e_libelle;
    }

    public function setELibelle(string $e_libelle): static
    {
        $this->e_libelle = $e_libelle;

        return $this;
    }
}
