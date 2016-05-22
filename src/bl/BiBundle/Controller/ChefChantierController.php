<?php

namespace bl\BiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;



use bl\BiBundle\Entity\Chantier ;
use bl\BiBundle\Entity\Mission ;
use bl\BiBundle\Entity\Affectation ;



use bl\BiBundle\Form\ChantierType ;
use bl\BiBundle\Form\MissionType ;

class ChefChantierController extends Controller
{
    public function listeChantiersAction(){
        
        $repChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Chantier");
        
        $session = $this->get("session");
        $chefChantier = $session->get("utilisateur") ;
        
        $listeChantier = $repChantier->findByChefChantier($chefChantier) ;
        
        return $this->render('blBiBundle:Body:ListeChantiers.html.twig', array(
            'liste' => $listeChantier));
        
    }
    
    
    public function ajouterChantierAction(){
        
        $chantier = new Chantier() ;
        
        $form = $this->createForm(new ChantierType(), $chantier);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $session = $this->get("session");
            $id = $session->get("utilisateur")->getId() ;
            $repChefChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:ChefChantier");
            $chefChantier = $repChefChantier->findOneById($id) ;
            
            $chantier->setChefChantier($chefChantier);
           
            
            $em->persist($chantier);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_chefChantier_listeChantiers") ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterChantier.html.twig', array(
            'form' => $form->createView()));
        
    }
    
    public function detailChantierAction($id){
        
        $repChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Chantier");
        $chantier = $repChantier->findOneById($id) ;
        
        return $this->render('blBiBundle:Body:DetailChantier.html.twig', array(
            'chantier' => $chantier));
        
    }
    
    public function modifierChantierAction($id){
        
        $repChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Chantier");
        $chantier = $repChantier->findOneById($id) ;
        
        $form = $this->createForm(new ChantierType(), $chantier);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($chantier);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_chefChantier_listeChantiers") ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterChantier.html.twig', array(
            'form' => $form->createView()));
        
    }
    

    public function supprimerChantierAction($id){
        
        $repChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Chantier");
        $chantier = $repChantier->findOneById($id) ;
        
        $em = $this->getDoctrine()->getManager();
            
        $em->remove($chantier);
                
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_chefChantier_listeChantiers") ;
        
    }
    
    public function ajouterMissionAction($id){
        
        $mission = new Mission() ;
        
        $form = $this->createForm(new MissionType(), $mission);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $repChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Chantier");
            $chantier = $repChantier->findOneById($id) ;
            
            $mission->setChantier($chantier);
           
            
            $em->persist($mission);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_chefChantier_detailChantier", array("id" => $id)) ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterMission.html.twig', array(
            'form' => $form->createView(),
            "id" => $id));
        
    }
    
    
    
    public function modifierMissionAction($id){
        
        $repMission = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Mission");
        $mission = $repMission->findOneById($id) ;
        $idChantier = $mission->getChantier()->getId() ;
        $form = $this->createForm(new MissionType(), $mission);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($mission);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_chefChantier_detailChantier", array("id" => $idChantier)) ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterMission.html.twig', array(
            'form' => $form->createView(),
            "id" => $idChantier));
        
    }
    

    public function supprimerMissionAction($id){
        
        $repMission = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Mission");
        $mission = $repMission->findOneById($id) ;
        $idChantier = $mission->getChantier()->getId() ;
        
        $em = $this->getDoctrine()->getManager();
            
        $em->remove($mission);
                
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_chefChantier_detailChantier", array("id" => $idChantier)) ;
        
    }
    
    public function listeAffectationsAction($id){
        
        $repAffectation = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Affectation");
        $repMission = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Mission");
        $mission = $repMission->findOneById($id) ;
        
        $listeAffectation = $repAffectation->findByMission($mission) ;
        
        return $this->render('blBiBundle:Body:ListeAffectationsMission.html.twig', array(
            'liste' => $listeAffectation,
            'mission' => $mission ));
        
    }
    
    
    
    
    public function ajouterAffectationAction($id){
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $repMission = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Mission");
        $mission = $repMission->findOneById($id) ;
        
        $listeArtisan = $repArtisan->disponiblesPourMission($mission) ;
       
          
        return $this->render('blBiBundle:Body:ListeArtisansAffectation.html.twig', array(
            'liste' => $listeArtisan,
            'idMission' => $id
            ));
        
    }
    
    
    
    public function supprimerAffectationAction($id){
        
        $repAffectation = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Affectation");
        $affectation = $repAffectation->findOneById($id) ;
        
        $idMission = $affectation->getMission()->getId();
        $em = $this->getDoctrine()->getManager();
            
        $em->remove($affectation);
                
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_chefChantier_listeAffectations", array("id" => $idMission)) ;
        
    }
    
    public function choisirAffectationAction($idMission, $idArtisan){
        
        $affectation = new Affectation() ;
        
        $em = $this->getDoctrine()->getManager() ;
        
        $repMission = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Mission");
        $mission = $repMission->findOneById($idMission) ;
        $affectation->setMission($mission);

        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $artisan = $repArtisan->findOneById($idArtisan) ;
        
        $affectation->setArtisan($artisan);
        
        $affectation->setDateAffectation(new \DateTime());

        $affectation->setStatut("proposee") ;
        
        
        $em->persist($affectation);
        $em->flush();

        return $this->redirectToRoute("bl_bi_chefChantier_listeAffectations", array("id"=> $idMission)) ;

      
    }
    
    
    public function listeArtisansDisponiblesAction(){
        
        
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $listeArtisan = array() ;
        $form = $this->createFormBuilder()
                ->add("date", "date")
                ->add("corpsMetier", "entity", array('class' => 'blBiBundle:CorpsMetier'))
                ->add("rechercher", "submit")
                ->add("reinitialiser", "reset")
                ->getForm();
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $donnee = $form->getData();
            $date = $donnee["date"];
            $corpsMetier = $donnee["corpsMetier"];
            
            $listeArtisan = $repArtisan->disponiblesParDateEtCorps($date, $corpsMetier) ;
        }
        
          
        return $this->render('blBiBundle:Body:ListeArtisansDisponibles.html.twig', array(
            'liste' => $listeArtisan,
            'form' => $form->createView()));
        
    }
    
    public function detailArtisanAction($id){
        
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $artisan = $repArtisan->findOneById($id) ;
        
        return $this->render('blBiBundle:Body:DetailArtisanChefChantier.html.twig', array(
            'artisan' => $artisan));
        
    }
    
}
