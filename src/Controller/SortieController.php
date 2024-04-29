<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Campus;
use App\Entity\Sortie;

/**
 * @Route("/accueil", name="accueil")
 */
class SortieController extends AbstractController
{
    #[Route("/", "affichage")]
    public function accueil(): Response
    {
        return $this->render('main/accueil.html.twig');
    }
    #[Route("/test", "affichage_test")]
    public function test(): Response
    {
        /*
        $campusRepository = $this->getDoctrine()->getRepository(Campus::class);
        $campuses = $campusRepository->findAll();
        $SortieRepository = $this->getDoctrine()->getRepository(Campus::class);
        $sortie = $SortieRepository->findAll();
        */
        $campuses = ["id" => 1,
            "c_nom"=>"Saint Herblain"
        ];

        $sortie = [
            "s_nom" => "Visite musée",
            "s_date_heure_debut" => "23/07/24 15:00",
            "s_date_limite_inscription" => "19/07/24",
            "s_nombre_inscription_max" => "3/8",
            "s_etat" => "Ouvert",
            "s_organisateur" => "Jean Jean",
        ];

        return $this->render('main/accueil.html.twig',[
            "uneSortie" => $sortie,
            'campuses' => $campuses,]);
    }

    /**
     * @Route("/liste-sortie", name="liste_sortie")
     */
    public function getSorties(Request $request): Response
    {
        $campusId = $request->query->get('campusId');
        // Récupérer les sorties associées au campus sélectionné
        $sorties = $this->getDoctrine()->getRepository(Event::class)->findBy(['campus' => $campusId]);

        // Rendre le template Twig pour le tableau de sorties
        return $this->render('morceaux/events_table.html.twig', [
            'uneSortie' => $sorties,
        ]);
    }
}