<?php

namespace App\Controller\Back;

use App\Entity\Subproject;
use App\Form\SubprojectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/soniaHammou/sous-projets/', name: 'app_back_subproject_')]

class SubprojectController extends AbstractController
{
    #[Route('{id}', name: 'show',  requirements: ['id' => '\d+'], methods:'GET')]
    public function show(Subproject $subproject): Response
    {
        return $this->render('back/subproject/show.html.twig', [
            'subproject' => $subproject,
        ]);
    }

    #[Route('ajouter', name: 'add')]
    public function add(Request $request , EntityManagerInterface $em): Response
    {

        $subproject = new Subproject;

       $form =  $this->createForm(SubprojectType::class, $subproject);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

        $em->persist($subproject);
        $em->flush();
        // TODO:reflchir au status du projet
        $this->addFlash('success','creation sous projets reussi');

            // TODO:redirigé vers le current projet
    return $this->redirectToRoute('app_back_projet_list');

}

        return $this->render('back/subproject/add.html.twig', [
            'form' => $form,
        ]);
    }


}
