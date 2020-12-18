<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VoitureType;
use Symfony\Component\HttpFoundation\Request;





class VoitureController extends AbstractController
{
    /**
     * @Route("/createvoiture", name="create_voiture")
     * 
     */
    public function createvoiture(Request $request): Response
    {
       $voiture=new voiture();
       $form=$this->createform(voitureType::class,$voiture);
       $form->handleRequest($request);
       if($form->isSubmitted())
       {
           $voiture->setDisponibilite(1);
           $sentityManager=$this->getDoctrine()->getManager();
           $entityManager->flush();
           return $this->redirectToRoute('voiture');
       }
    return $this->render('voiture/ajouter.html.twig',[
        'form' => $form->createView()
        ]);
    
        
    }
    /**
     * @Route("/voiture", name="voiture")
     */

    
    public function index():Response
    {

        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findall();

        return $this->render('voiture/index.html.twig', [
            'voitures' =>$voitures,
        ]);
    }
    /**
     * @Route("/voiture/{mat}", name="voiturebymat")
     */
    
    public function afficher(String $mat): Response{

        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findBy(array('matricule' => $mat));

        return $this->render('voiture/index.html.twig', [
            'voitures' =>$voitures,
        ]);
    }
    
     
 /**
     *@Route("/modifierrvoiture/{mat}", name="modifierrvoiture") 
     */

    public function modifier(Request $request, String $mat): Response {


        $entitymanager = $this->getDoctrine()->getManager();
        $voitures=$this->getDoctrine()->getRepository(voiture::class)->findBy(array('matricule' => $mat));
        if (!$voitures) {
            throw $this->createNotfoundException(
                'Pas de voiture avec la matricule' , $mat
            );
        }


        $voiture = $voitures[0];
        $form = $this->createform(VoitureType::class, $voiture);

        $form->handleRequest($request);

        if ( $form->isSubmitted() ) {
            $voiture->setDisponibilite(1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('voiture');


     }
     return $this->render('voiture/modifier.html.twig', [
        'form' => $form->createView()
    ]);
}
/**
 * @Route("/supprimervoiture/{mat}",name="supprimervoiturebymat")
 */

 public function supprimer(string $mat): Response{
     
    $entitymanager = $this->getDoctrine()->getManager();
    $voiture=$this->getDoctrine()->getRepository(voiture::class)->findBy(array('matricule' => $mat));
    if (!$voiture) {
        throw $this->createNotfoundException(
            'Pas de voiture avec la matricule' , $mat
        );
    }


    
    $entitymanager->remove($voiture[0]);
    $entitymanager->flush();

    return $this->redirectToRoute('voiturebymat', ['mat' => $mat]);
 }
 

}
