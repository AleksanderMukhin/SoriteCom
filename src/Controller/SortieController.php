<?php

namespace App\Controller;

use App\Entity\Sortie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/accueil", "accueil_")]
class SortieController
{
    #[Route("/", "liste")]
    public function accueil()
    {
        return $this->render('main/accueil.html.twig');
    }
    #[Route("/test", "liste_test")]
    public function test(){

        $sortie = [
            "s_nom" => "Visite musée",
            "s_date_heure_debut" => "23/07/24 15:00",
            "s_date_limite_inscription" => "19/07/24",
            "s_nombre_inscription_max" => "3/8",
            "s_etat" => "Ouvert",
            "s_organisateur" => "Jean Jean",
        ];

        return $this->render('main/accueil.html.twig',["uneSortie" => $sortie]);
    }
}