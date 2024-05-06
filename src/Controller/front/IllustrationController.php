<?php

namespace App\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IllustrationController extends AbstractController
{
    #[Route('/illustration', name: 'app_illustration')]
    public function index(): Response
    {
        return $this->render('front/illustration/index.html.twig', [
            'controller_name' => 'IllustrationController',
        ]);
    }
}
