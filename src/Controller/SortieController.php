<?php

namespace App\Controller;


use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Form\SortieType;
use App\Service\SortieService;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Campus;
use App\Entity\Sortie;

class SortieController extends AbstractController
{
    #[Route("/sortie/creer", name: "sortie_creer", methods: ["GET", "POST"])]
    public function creerSortie(Request $request, SortieService $sortieService, Security $security): Response
    {
        $sortie = new Sortie();
        $form = $this->createForm(SortieType::class, $sortie);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'utilisateur connecté
            $user = $security->getUser();

            // Enregistrer la sortie dans la base de données en utilisant le service SortieService
            $sortieService->creerSortie($sortie, $user);
    
            $this->addFlash('success', 'Sortie créée avec succès.');
    
            return $this->redirectToRoute('accueil');
        }
    
        // Récupérer les données pour la variable "campuses" depuis votre source de données appropriée
        $campuses = [
            ["id" => 1, "nom" => "Campus 1"],
            ["id" => 2, "nom" => "Campus 2"]
        ];
    
        return $this->render('main/creer.html.twig', [
            'form' => $form->createView(),
            'campuses' => $campuses, // Passer les campuses à votre template
        ]);
    }

     /**
     * @Route("/sortie/{id}/supprimer", name="supprimer_sortie")
     */
    public function supprimerSortie($id): Response
    {
    $entityManager = $this->getDoctrine()->getManager();
    $sortie = $entityManager->getRepository(Sortie::class)->find($id);

    if (!$sortie) {
        throw $this->createNotFoundException('La sortie n\'existe pas');
    }

    $entityManager->remove($sortie);
    $entityManager->flush();

    return $this->redirectToRoute('accueil');
    }
    
    #[Route("/accueil", "accueil")]
    public function test(SortieRepository $SortieRepository): Response
    {
        $campusRepository = $this->getDoctrine()->getRepository(Campus::class);
        $campuses = $campusRepository->findAll();
        //$SortieRepository = $this->getDoctrine()->getRepository(Sortie::class);
        $sortie = $SortieRepository->findAll();



        return $this->render('main/morceaux/table_sorties.html.twig', [
            'sorties' => $sortie,
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
            $userId = $this->getUser()->getId();
            $queryBuilder
                ->innerJoin('s.s_organisateur', 'u')
                ->andWhere('u.id = :userId')
                ->setParameter('userId', $userId);
        }
        if ($etreInscrit) {
            $userId = $this->getUser()->getId();
            $queryBuilder
                ->innerJoin('s.participants', 'u')
                ->andWhere('u.id = :userId')
                ->setParameter('userId', $userId);
        }
        if ($nonInscrit) {
            $userId = $this->getUser()->getId();
            $subQueryBuilder = $sortieRepository->createQueryBuilder('s2');
            $subQueryBuilder
                ->select('s2.id')
                ->leftJoin('s2.participants', 'u') // En supposant que 'participants' est le nom de la relation ManyToMany avec l'entité Utilisateur
                ->andWhere('u.id = :userId')
                ->setParameter('userId', $userId);
            $queryBuilder
                ->andWhere($queryBuilder->expr()->notIn('s.id', $subQueryBuilder->getDQL()));
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
    /**
     * @Route("/accueil/modification_sortie/{id}", name="modification_sortie")
     */
    public function modificationSortie(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $sortie = $entityManager->getRepository(Sortie::class)->find($id);
        $campusRepository = $this->getDoctrine()->getRepository(Campus::class);
        $campuses = $campusRepository->findAll();
    
        if (!$sortie) {
            throw $this->createNotFoundException('Sortie non trouvée');
        }
        $form = $this->createForm(SortieType::class, $sortie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer les modifications de la sortie
            $entityManager->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->render('main/modifier.html.twig', [
            'form' => $form->createView(),
            'campuses' => $campuses,
            'sortie' => $sortie, // Passer la sortie au template
        ]);
    }
    

// #[Route("/accueil/details/{id}", "accueil_details")]
#[Route("/accueil/details/{id}", "sortie_details")]
    public  function details(int $id, SortieRepository $SortieRepository): Response
    {
        $sortie=$SortieRepository->find($id);

        if(!$sortie){
            throw $this->createNotFoundException('oh no!!!');
        }

        return $this->render('sortie/details.html.twig', ['sortie'=>$sortie]);
    }
}