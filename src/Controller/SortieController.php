<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Campus;
use App\Entity\Sortie;

// Baptiste: L'erreur venais de la varibale campuses qui n'etait pas envoyer sur la twig apparement?
class SortieController extends AbstractController
{
    #[Route("/accueil", "accueil")]
    public function accueil(): Response
    {
        $campuses = [
            ["id" => 1, "c_nom" => "Saint Herblain"],
            ["id" => 2, "c_nom" => "Autre Campus"]
        ];
    
        return $this->render('main/accueil.html.twig', [
            'campuses' => $campuses,
        ]);
    }

    #[Route("/accueil/test", "accueil_test")]
    public function test(): Response
    {
        $campuses = [
            ["id" => 1, "c_nom" => "Saint Herblain"],
            ["id" => 2, "c_nom" => "Autre Campus"]
        ];

        $sortie = [
            "s_nom" => "Visite musée",
            "s_date_heure_debut" => "23/07/24 15:00",
            "s_date_limite_inscription" => "19/07/24",
            "s_nombre_inscription_max" => "3/8",
            "s_etat" => "Ouvert",
            "s_organisateur" => "Jean Jean",
        ];

        return $this->render('main/accueil.html.twig', [
            'uneSortie' => $sortie,
            'campuses' => $campuses, 
        ]);
    }

    #[Route("/accueil/liste", "accueil_liste")]
    public function getSorties(Request $request): Response
    {
        $campusId = $request->query->get('campusId');
        $sorties = $this->getDoctrine()->getRepository(Sortie::class)->findBy(['campus' => $campusId]);

        return $this->render('main/morceaux/table_sorties.html.twig', [
            'uneSortie' => $sorties,
        ]);
    }
}
