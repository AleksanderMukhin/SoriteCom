<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Campus;
use App\Entity\Sortie;

class SortieController extends AbstractController
{
    #[Route("/accueil", "accueil")]
    public function accueil(): Response
    {
        return $this->render('main/accueil.html.twig');
    }
    #[Route("/accueil/test", "accueil_test")]
    public function test(): Response
    {
        /*
        $campusRepository = $this->getDoctrine()->getRepository(Campus::class);
        $campuses = $campusRepository->findAll();
        $SortieRepository = $this->getDoctrine()->getRepository(Campus::class);
        $sortie = $SortieRepository->findAll();
        */
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

        return $this->render('main/morceaux/table_sorties.html.twig', [
            'uneSortie' => $sortie,
            'campuses' => $campuses,
        ]);
    }

    #[Route("/accueil/liste", "accueil_liste")]
    public function getSorties(Request $request): Response
    {
        $campusId = $request->query->get('campusId');
        // Récupérer les sorties associées au campus sélectionné
        $sorties = $this->getDoctrine()->getRepository(Sortie::class)->findBy(['campus' => $campusId]);

        // Rendre le template Twig pour le tableau de sorties
        return $this->render('main/morceaux/table_sorties.html.twig', [
            'uneSortie' => $sorties,
        ]);
    }
}