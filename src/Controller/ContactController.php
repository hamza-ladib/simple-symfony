<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
//////////////////////////
class ContactController extends AbstractController
{

/////////////////////////////////////

 /**
     * @Route("/home", name="app_contact")
     */
public function allContacts( Request $request,ManagerRegistry $doctrine,): Response
{
    $allContacts = $doctrine->getRepository(Contact::class)->findAll();
    //////////////////////////////////
    ////////////////////////////////////
    

    return $this->render('contact/index.html.twig', [
        'contacts' => $allContacts,
    ]);    

}
}