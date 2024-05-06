<?php

namespace App\Controller\front;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name: 'app_project_')]
class ProjectController extends AbstractController
{
    #[Route('/projets', name: 'list')]
    public function list(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('front/project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    //param converter
    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'])]
    public function show(Project $project): Response
    {
        
        return $this->render('front/project/show.project.html.twig', [
            'project' => $project,

        ]);
    }
}
