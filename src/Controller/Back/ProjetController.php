<?php

namespace App\Controller\Back;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/soniaHammou/', name: 'app_back_projet_')]
class ProjetController extends AbstractController
{

   
    #[Route('projets', name: 'list', methods:"GET")]
    public function list(ProjectRepository $projectRepository): Response
    {
        $projetsList = $projectRepository->findAll();


        return $this->render('back/projet/index.html.twig', [
            'projetsList' => $projetsList,
        ]);
    }


    // ! conseillé de faire le plus de validation dans l'url
    #[Route('{id<\d+>}', name: 'show', methods:"GET")]
    public function show(Project $project): Response
    {
        return $this->render('back/projet/show.html.twig', [
            'project' => $project,
        ]);
    }

// create / read / update /delete
    #[Route('update/{id<\d+>}', name: 'update',  requirements: ['id' => '\d+'])]
    public function update( Project $project, Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success','modification reussi');

         return $this->redirectToRoute('app_back_projet_list');
     }

    return $this->render('back/projet/update.html.twig', [
        'project' => $project,
        'form' => $form,

    ]);

}

        #[Route('ajouter', name: 'add')]
        public function add(Request $request, EntityManagerInterface $em): Response
        {
            $projet = new Project;

            $form = $this->createForm(ProjectType::class, $projet);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($projet);

                $em->flush();
                $this->addFlash('success','creation reussi');

            return $this->redirectToRoute('app_back_projet_list');

        }

        return $this->render('back/projet/add.html.twig', [
            'form' => $form,

        ]);

        }


        #[Route('archiver/{id}', name: 'archiver', requirements: ['id' => '\d+'])]
        public function archive(Project $project, EntityManagerInterface $em): Response
        {
            $project->setStatus("Archivé");

            $em->flush();
    
            $this->addFlash('success', 'Projet Archivé');
            return $this->redirectToRoute('app_back_projet_list');
        
        }

        #[Route('publish/{id}', name: 'publishPost', methods:"GET", requirements: ['id' => '\d+'])]
        public function publishPost(Project $project, EntityManagerInterface $em): Response
        {

            $project->setStatus("Publié");

            $em->flush();
    
            $this->addFlash('success', 'Projet publié');
            return $this->redirectToRoute('app_back_projet_list');
        
        }


}
