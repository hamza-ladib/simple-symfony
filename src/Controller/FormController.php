<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\Persistence\ManagerRegistry;
class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function index( Request $request,ManagerRegistry $doctrine): Response
    {
          $contact= new Contact();
           $form=$this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $add = $doctrine->getManager();
            $add->persist($contact);
            $add->flush();
            return $this->redirectToRoute('app_contact');
     

        }
        return $this->render('form/index.html.twig', [
            'my_form' => $form->createView(),
        ]);
    }

    #[Route('edit/{id}', name: 'edit_contact')]
    public function edit( Request $request,ManagerRegistry $doctrine,$id): Response
    {
    
$contact= $doctrine->getRepository(Contact::class)->find($id); 
          $form=$this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $add = $doctrine->getManager();
            $add->flush();
           return $this->redirectToRoute('app_contact');
        }
        return $this->render('form/index.html.twig', [
            'my_form' => $form->createView(),
        ]);
    }
    ////////////////// delet ///////////////////////
    #[Route('/del/{id}', name: 'delete_contact')]
    public function remove( Request $request,ManagerRegistry $doctrine,$id): Response
    {
    
$contact= $doctrine->getRepository(Contact::class)->find($id); 
            $del = $doctrine->getManager();
            $del->remove($contact);
            $del->flush();
            return $this->redirectToRoute('app_contact');
    }
















}
