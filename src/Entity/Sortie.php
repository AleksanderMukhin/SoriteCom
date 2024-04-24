<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $s_nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $s_description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $s_date_heure_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $s_duree = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $s_date_limite_inscription = null;

    #[ORM\Column]
    private ?int $s_nombre_inscription_max = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSNom(): ?string
    {
        return $this->s_nom;
    }

    public function setSNom(string $s_nom): static
    {
        $this->s_nom = $s_nom;

        return $this;
    }

    public function getSDescription(): ?string
    {
        return $this->s_description;
    }

    public function setSDescription(?string $s_description): static
    {
        $this->s_description = $s_description;

        return $this;
    }

    public function getSDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->s_date_heure_debut;
    }

    public function setSDateHeureDebut(\DateTimeInterface $s_date_heure_debut): static
    {
        $this->s_date_heure_debut = $s_date_heure_debut;

        return $this;
    }

    public function getSDuree(): ?\DateTimeInterface
    {
        return $this->s_duree;
    }

    public function setSDuree(\DateTimeInterface $s_duree): static
    {
        $this->s_duree = $s_duree;

        return $this;
    }

    public function getSDateLimiteInscription(): ?\DateTimeInterface
    {
        return $this->s_date_limite_inscription;
    }

    public function setSDateLimiteInscription(\DateTimeInterface $s_date_limite_inscription): static
    {
        $this->s_date_limite_inscription = $s_date_limite_inscription;

        return $this;
    }

    public function getSNombreInscriptionMax(): ?int
    {
        return $this->s_nombre_inscription_max;
    }

    public function setSNombreInscriptionMax(int $s_nombre_inscription_max): static
    {
        $this->s_nombre_inscription_max = $s_nombre_inscription_max;

        return $this;
    }
}
