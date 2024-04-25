<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $v_nom = null;

    #[ORM\Column]
    private ?int $v_code_postal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVNom(): ?string
    {
        return $this->v_nom;
    }

    public function setVNom(string $v_nom): static
    {
        $this->v_nom = $v_nom;

        return $this;
    }

    public function getVCodePostal(): ?int
    {
        return $this->v_code_postal;
    }

    public function setVCodePostal(int $v_code_postal): static
    {
        $this->v_code_postal = $v_code_postal;

        return $this;
    }
}
