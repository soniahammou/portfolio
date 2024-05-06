<?php

namespace App\Controller\Back;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/soniaHammou/', name: 'app_back_main_')]
class MainController extends AbstractController
{
     
    #[Route('home', name: 'home', methods:"GET")]
    public function home(ProjectRepository $projectRepository): Response
    {
        $projetsList = $projectRepository->findBy(
            [],
            ['created_at' => 'DESC'],
            4 // Limite les résultats à 4       
         );
  

        return $this->render('back/main/home.html.twig', [
            'projetsList' => $projetsList,
        ]);
    }
}

