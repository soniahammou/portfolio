<?php

namespace App\Controller\front;

use App\Repository\TagsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TagsController extends AbstractController
{
    #[Route('/tags', name: 'app_tags')]
    public function index(TagsRepository $tagsRepository): Response
    {
        $list = $tagsRepository->findAll();
        return $this->render('front/tags/index.html.twig', [
            'controller_name' => 'TagsController',
            'list' =>  $list,

        ]);
    }
}
