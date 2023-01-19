<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Entity\Contact;
use App\Entity\TypeDemande;
use App\Repository\ContactRepository;
use App\Repository\TypeDemandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use App\fonctions\Fonctions;

class ContactController extends AbstractController
{
    //fonction création d'un contact depuis un formulaire de contact twig
    #[Route('/contact/mail', name: 'app_contact')]
    public function index(Request $request, 
    EntityManagerInterface $em,
    Fonctions $mail): Response
    {   
        //import des ressources 
        require '../vendor/autoload.php';
        require 'smtp.php';
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid()){
            $em->persist($contact);
            $em->flush();
            //récupération de l'objet du contact 
            $objet = $contact->getObjetContact();
            $body = $contact->getContenuContact();
            //envoi du mail
            $mail->email($objet, $body, $id, $mdp);
            return $this->redirectToRoute('app_contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //fonction création d'un contact depuis json (API)
    #[Route('/api/addContact', name: 'app_api_add', methods: 'POST')]
    public function addContact(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        TypeDemandeRepository $typeRepo
        ): Response {
            //récupération du json
            $contact_recup = $request->getContent();
            //décodage du json recu
            $data = $serializer->decode($contact_recup, 'json');
            //création d'un nouveau contact
            $contact = new Contact();
            $contact->setObjetContact($data['objetContact']);
            $contact->setContenuContact($data['contenuContact']);
            $contact->setNomContact($data['nomContact']);
            $contact->setPrenomContact($data['prenomContact']);
            $contact->setMailContact($data['mailContact']);
            $contact->setEntrepriseContact($data['entrepriseContact']);
            //$contact->setTypeDemandes($data['typeDemandes']);
            $contact->setTypeDemandes($typeRepo->find($data['typeDemandes']));
            //on fait persister les données
            $em->persist($contact);
            //envoi en BDD
            $em->flush();
            //dump and die de $cat
            dd($contact);
    }

    //fonction récupération de tous les contacts
    #[Route('/api/getContact', name: 'app_api_get', methods: 'GET')]
    public function getContact(
        NormalizerInterface $normalizer,
        TypeDemandeRepository $typeRepo,
        ContactRepository $contactRepo
        ): Response{
            //dd($contactRepo->findAll());
            return $this->json($contactRepo->findAll(),200, 
            ['Content-Type'=>'application/json','Access-Control-Allow-Origin'=> '*'], ['groups' => 'ct']);
        }    
}
