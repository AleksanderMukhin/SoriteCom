<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sNom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $sDescription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $sDateHeureDebut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $sDuree = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $sDateLimiteInscription = null;

    #[ORM\Column]
    private ?int $sNombreInscriptionMax = null;

   
    #[ORM\ManyToOne(targetEntity: "App\Entity\Campus")]
    #[ORM\JoinColumn(name: "s_campus_id", referencedColumnName: "id")]
    private ?Campus $sCampus = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat")
     * @ORM\JoinColumn(name="s_etat_id", referencedColumnName="id", nullable=false)
     */
    private ?Etat $sEtat = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $sOrganisateur = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'sortie')]
    private Collection $participant;

    public function __construct()
    {
        $this->participant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSNom(): ?string
    {
        return $this->sNom;
    }

    public function setSNom(string $sNom): static
    {
        $this->sNom = $sNom;

        return $this;
    }

    public function getSDescription(): ?string
    {
        return $this->sDescription;
    }

    public function setSDescription(?string $sDescription): static
    {
        $this->sDescription = $sDescription;

        return $this;
    }

    public function getSDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->sDateHeureDebut;
    }

    public function setSDateHeureDebut(\DateTimeInterface $sDateHeureDebut): static
    {
        $this->sDateHeureDebut = $sDateHeureDebut;

        return $this;
    }

    public function getSDuree(): ?\DateTimeInterface
    {
        return $this->sDuree;
    }

    public function setSDuree(\DateTimeInterface $sDuree): static
    {
        $this->sDuree = $sDuree;

        return $this;
    }

    public function getSDateLimiteInscription(): ?\DateTimeInterface
    {
        return $this->sDateLimiteInscription;
    }

    public function setSDateLimiteInscription(\DateTimeInterface $sDateLimiteInscription): static
    {
        $this->sDateLimiteInscription = $sDateLimiteInscription;

        return $this;
    }

    public function getSNombreInscriptionMax(): ?int
    {
        return $this->sNombreInscriptionMax;
    }

    public function setSNombreInscriptionMax(int $sNombreInscriptionMax): static
    {
        $this->sNombreInscriptionMax = $sNombreInscriptionMax;

        return $this;
    }

    public function getSCampus(): ?Campus
    {
        return $this->sCampus;
    }

    public function setSCampus(?Campus $sCampus): static
    {
        $this->sCampus = $sCampus;

        return $this;
    }

    public function getSEtat(): ?Etat
    {
        return $this->sEtat;
    }

    public function setSEtat(?Etat $sEtat): static
    {
        $this->sEtat = $sEtat;

        return $this;
    }

    public function getSOrganisateur(): ?User
    {
        return $this->sOrganisateur;
    }

    public function setSOrganisateur(?User $sOrganisateur): static
    {
        $this->sOrganisateur = $sOrganisateur;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getParticipant(): Collection
    {
        return $this->participant;
    }

    public function addParticipant(User $participant): static
    {
        if (!$this->participant->contains($participant)) {
            $this->participant->add($participant);
        }

        return $this;
    }

    public function removeParticipant(User $participant): static
    {
        $this->participant->removeElement($participant);

        return $this;
    }
}
