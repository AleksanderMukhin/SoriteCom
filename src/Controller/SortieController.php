<?php

namespace App\Controller;


use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Campus;
use App\Entity\Sortie;

class SortieController extends AbstractController
{
    #[Route("/accueil", "accueil")]
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

    #[Route("/accueil/recherche", "liste_recherche")]
    public function tri(Request $request, SortieRepository $sortieRepository): Response{

        $campusId = $request->query->get('campus');
        $champRecherche = $request->request->get('champRecherche');
        $dateMin = $request->request->get('rechercheDateMin');
        $dateMax = $request->request->get('rechercheDateMax');
        $etreOrganisateur = $request->request->get('etreOrganisateur');
        $etreInscrit = $request->request->get('etreInscrit');
        $nonInscrit = $request->request->get('nonInscrit');
        $passee = $request->request->get('passee');


        $queryBuilder = $sortieRepository->createQueryBuilder('s');

        if ($campusId !== null) {
            $queryBuilder
                ->andWhere('s.s_campus = :campus')
                ->setParameter('campus', $campusId);
        }
        if ($champRecherche !== null) {
            $queryBuilder
                ->andWhere('s.s_nom LIKE :champRecherche')
                ->setParameter('champRecherche', '%'.$champRecherche.'%');
        }
        if ($dateMin !== null && $dateMax !== null) {
            $queryBuilder
                ->andWhere('s.s_dateHeureDebut BETWEEN :dateMin AND :dateMax')
                ->setParameter('dateMin', new \DateTime($dateMin))
                ->setParameter('dateMax', new \DateTime($dateMax));
        }
        /*if ($etreOrganisateur) {
            // À ajuster
        }
        if ($etreInscrit) {
            // À ajuster
        }
        if ($nonInscrit) {
            // À ajuster
        }*/
        //à modifier
        if ($passee) {
            $queryBuilder
                ->andWhere('s.s_dateHeureDebut < :now')
                ->setParameter('now', new \DateTime());
        }

        //execution de la requête
        $sorties = $queryBuilder->getQuery()->getResult();

        // Rendre le template Twig pour le tableau de sorties
        return $this->render('main/morceaux/table_sorties.html.twig', [
            'sorties' => $sorties,
        ]);
    }
}