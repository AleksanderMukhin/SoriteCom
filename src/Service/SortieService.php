<?php

namespace App\Service;

use App\Entity\Sortie;
use App\Entity\User;
use App\Entity\Etat; // Importez l'entité Etat si ce n'est pas déjà fait
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SortieService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function creerSortie(Sortie $sortie, UserInterface $organisateur): void
    {
        $sortie->setSOrganisateur($organisateur);
        // Obtenez l'entité Etat par défaut (supposons que son ID est 1)
        $etatIdParDefaut = 1;

        // Récupérez une référence à l'entité Etat par défaut
        $etatParDefaut = $this->entityManager->getReference(Etat::class, $etatIdParDefaut);

        // Définissez l'état de la sortie sur l'état par défaut
        $sortie->setSEtat($etatParDefaut);

        // Persistez la sortie
        $this->entityManager->persist($sortie);
        $this->entityManager->flush();
    }
}
