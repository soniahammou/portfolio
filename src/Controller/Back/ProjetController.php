<?php

namespace App\Controller\Back;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/soniaHammou/', name: 'app_back_projet_')]
class ProjetController extends AbstractController
{

    //TODO:verifier les redirect 
   
    #[Route('projets', name: 'list')]
    public function list(ProjectRepository $projectRepository, Request $request): Response
    {
        ///je recupere la liste des projets pour les afficher dynamiquement sur le form 
        $list = $projectRepository->findAll();

        // je récupére la valeur du select search 
        $searchTerm = $request->get('search');

   
        // je compare les valeur avec le voir tout ou les titres
     if ($searchTerm == "Voir tout") {
            $projetsList = $projectRepository->findAll();
        }  else{
            $projetsList= $projectRepository->findBy(
                ['title' => $searchTerm],
                ['created_at' => 'ASC'] 
            );
    

        }

        return $this->render('back/projet/index.html.twig', [
            'projetsList' => $projetsList,
            'list' => $list,
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

    #[Route('update/{id<\d+>}', name: 'update',  requirements: ['id' => '\d+'])]
    public function update( Project $project, Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {

                // /**
                //  * @var UploadedFile $file
                //  */
                // le getdata recueprer les données soumises dns un formulaire après validation
                // ! cette logique masqué sera gerer par le service vich uploader
                 // ? etape  1: recuperer le fichier pictureFile qui a été au préalable defini dans le projectType
                $file = $form->get('pictureFile')->getData();
                // // dd($file);
                            // // dd($file);
                if ($file) {
                    $fileName = $fileUploader->upload($file);

                    // ! logique uniquement pour les projets : je modifie l'image de la miniature et je supprime l'ancienne
                    $lastFile = $project->getPicture($fileName);

                    $imagePath = $this->getParameter('kernel.project_dir') . '/public/assets/images/' . $lastFile;
                    
                    
                    $filesystem = new Filesystem();
                    $filesystem->remove($imagePath);

                    $project->setPicture($fileName);

                }






            //  // ? etape 2 : generer le nom du fichier, : id.extension (ex : 12.jpg)
            // //  $fileName =  $project->getTitle() . '.' . $project->getId() . '.' . $file->getClientOriginalExtension();

            //     // // dd($fileName);

            //     /// ? etape 3 : j'utilise la methode move de l'entité uploadedfile, elle deplace le fichier vers une destination 
            //      // ? je recuperer le chemin absolu avec la commande : php bin/console debug:container --parameters | grep dir
            //     $file->move($this->getParameter('kernel.project_dir'). '/public/assets/images', $fileName);
                
            //     // ? etape 4 : je sauvegarge en base de donnée le nom du fichie dans la propriete picture de l entité project
            //     $project->setPicture($fileName);
            //     // dd($file->getClientOriginalExtension(), $file->getClientOriginalName());


            // ? etape 5 on flush :) 
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

        #[Route('publish/{id}', name: 'publish', methods:"GET", requirements: ['id' => '\d+'])]
        public function publishPost(Project $project, EntityManagerInterface $em): Response
        {

            $project->setStatus("Publié");

            $em->flush();
    
            $this->addFlash('success', 'Projet publié');
            return $this->redirectToRoute('app_back_projet_list');
        
        }


}
