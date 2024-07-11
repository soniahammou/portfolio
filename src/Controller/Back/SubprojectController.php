<?php

namespace App\Controller\Back;

use App\Entity\Subproject;
use App\Form\SubprojectSelectProjectType;
use App\Form\SubprojectType;
use App\Repository\ProjectRepository;
use App\Repository\SubprojectRepository;
use App\Service\ColorStatusService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Length;
use Twig\Node\Expression\Binary\SubBinary;

#[Route('/back/soniaHammou/sous-projets/', name: 'app_back_subproject_')]

class SubprojectController extends AbstractController
{  
    
    private $colorStatusService;

    public function __construct(ColorStatusService $colorStatusService)
    {
        $this->colorStatusService = $colorStatusService;
    }

    

    #[Route('liste', name: 'list',  requirements: ['id' => '\d+'])]
    public function list(SubprojectRepository $subprojectRepository,ProjectRepository $projectRepository , Request $request, PaginatorInterface $paginator): Response
    {       
        

        $projectChoice = $projectRepository->findAll();


        // ! affichage des noms des projets sur le select
        $searchTerm = $request->get('search');
        
        $projectChoice = $paginator->paginate($projectChoice, $request->query->getInt('page', 1), 10);



        // dd($searchTerm);
        if ($searchTerm == "Voir tout") {
            $subprojectsList = $subprojectRepository->findAll();
            $colorStatus = $this->colorStatusService->getAllColorStatus($subprojectsList);
            // $subprojectsList = array_merge($list, $colorStatus);

        } else {
       
        

        // ! affichage des projets sur la page en fonction du choix de l'utilisateur
        $subprojectsList = $subprojectRepository->findByProject($request->get('search'));
        // dd($subprojectsList);
        // mettre en place la pagination à l'aide du bundle KnpPaginatorBundle
        // on utilise la méthode paginate du paginator
        $subprojectsList = $paginator->paginate(
            // le tableau de données à paginer
            $subprojectsList,
            // le numéro de la page en cours
            $request->query->getInt('page', 1), /*page number*/
            // le nombre d'éléments par page
           4  /*limit per page*/
        ); 
        $colorStatus = $this->colorStatusService->getAllColorStatus($subprojectsList);
    }

        return $this->render('back/subproject/list.html.twig', [
            'subprojectsList' => $subprojectsList,
            'projectChoice' => $projectChoice,
            'colorStatus' => $colorStatus,

        ]);
    }


    #[Route('{id}', name: 'show',  requirements: ['id' => '\d+'], methods: 'GET')]
    public function show(Subproject $subproject): Response
    {
        $colorStatus = $this->colorStatusService->getColorStatusbyId($subproject);

        // dd($colorStatus);
        return $this->render('back/subproject/show.html.twig', [
            'subproject' => $subproject,
            'colorStatus' => $colorStatus,

        ]);
    }

    #[Route('ajouter', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {

        $subproject = new Subproject;

        $form =  $this->createForm(SubprojectType::class, $subproject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($subproject);
            $em->flush();
            $this->addFlash('success', 'creation sous projets reussi');

            //redirect to the current project
            return $this->redirect('/back/soniaHammou/sous-projets/' . $subproject->getId());
        }

        return $this->render('back/subproject/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('modifier/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function update(Subproject $subproject, Request $request, EntityManagerInterface $em): Response
    {

        $form =  $this->createForm(SubprojectType::class, $subproject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'modification du sous projets reussi');

            return $this->redirect('/back/soniaHammou/sous-projets/' . $subproject->getId());
        }

        return $this->render('back/subproject/update.html.twig', [
            'form' => $form,
            'subproject' => $subproject,

        ]);
    }


    /**
     * Modifie le status d'un projet : archivé
     */
    #[Route('archiver/{id}', name: 'archiver', requirements: ['id' => '\d+'])]
    public function archive(Subproject $subproject, EntityManagerInterface $em): Response
    {
        $subproject->setStatus("Archivé");

        $em->flush();

        $this->addFlash('success', 'Projet Archivé');
        return $this->redirectToRoute('app_back_projet_list');
    }



    /**
     * Modifie le status d'un projet : publié
     */
    #[Route('publish/{id}', name: 'publish', methods: "GET", requirements: ['id' => '\d+'])]
    public function publishSupbroject(Subproject $subproject, EntityManagerInterface $em): Response
    {
        $subproject->setStatus("Publié");

        $em->flush();

        $this->addFlash('success', 'Projet publié');
        return $this->redirectToRoute('app_back_projet_list');
    }
}
