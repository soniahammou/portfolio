<?php

namespace App\Controller\front;


use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_front')]
    public function index(ProjectRepository $projectRepository): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_USER');


        $projects = $projectRepository->findBy(
            [],
            ['created_at' => 'DESC'],
            //4 // Limite les résultats à 4       
         );
  

        return $this->render('front/main/index.html.twig', [
            'projects'=>$projects,
        ]);
    }
}
