<?php

namespace App\Controller\front;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    // ? INJECTION De la class Mailer, un service nous permettant d'envoyer un email
    public function index(Request $request, MailerInterface $mailer): Response
    {

        // ? creation d'un nouvel objet de la class DTO car aucune entité est relié au projet alors on en créer une 
        //initialise nos donné ' dto =data transfert Object'
        $data = new ContactDTO();

        //TODO A SUPPRIMER
        $data->firstname = "john ";
        $data->lastname = "doe";
        $data->email = "'hello@example.com";
        $data->message = "Super site !";

        // ? creation du formulaire avec le createForm
        //Contact form prend en arg la class du form, en scd parametre les données
        $form = $this->createForm(ContactType::class, $data);

        // ? Gestion de la requete contenant un formulaire
        $form->handleRequest($request);

        // ? Verification du formualire : est il soumis et valide ? 
        if ($form->isSubmitted() && $form->isValid()) {


            try {
                // on a la possiblité en plus de rendre un template sur twig
                $email = (new TemplatedEmail())
                    ->from($data->email)
                    //TODO METTRE MON MAIL
                    ->to('contact@example.com')
                    ->subject('demande de contact')
                    ->context(['data' => $data])
                    ->htmlTemplate('emails/contact.html.twig');

                $mailer->send($email);
                $this->addFlash('success', 'message envoyé');
                $this->redirectToRoute('app_contact');

            } catch (\Exception $e) {
                $this->addFlash('danger', 'Impossible d\'envoyer votre email');
            }
        }

        return $this->render('front/contact/contact.html.twig', [
            'form' => $form,
        ]);
    }
}
