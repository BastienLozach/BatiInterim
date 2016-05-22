<?php

namespace bl\BiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ConnexionController extends Controller
{
    
    public function deconnexionAction(){
        //$session = new Session();
        $session = $this->container->get('session');
        $session->invalidate();
        return $this->redirectToRoute("bl_bi_connexion");
    }
    
    public function connexionAction(){
        // Récupération des services
        $repUtilisateur = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Utilisateur");
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $repGestionnaire = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Gestionnaire");
        $repChefChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:ChefChantier");
        // Fin récupération des services
        
        $form = $this->createFormBuilder()
                ->add('login', 'text')
                ->add('motDePasse', 'password', array("required"=> false))
                ->add('valider', 'submit')
                ->add('annuler', 'reset')
                ->getForm();
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        $session = $this->container->get('session');
        $session->start();
        
        if($form->isValid()){
            $data = $form->getData();
            // Condition pour la connexion
            // Reste a allez vérifier dans la BDD
            $mdpClair = $data["motDePasse"] ;
            $mdp = md5($mdpClair);
            
            $utilisateurLambda = $repUtilisateur->findOneBy(array("login" => $data["login"], "mdp" => $mdp));
            
            if($utilisateurLambda != null){
                
                if($utilisateurLambda->getType() == "gestionnaire"){
                    $utilisateur = $utilisateurLambda->getGestionnaire();
                    
                }else if($utilisateurLambda->getType() == "artisan"){
                    $utilisateur = $utilisateurLambda->getArtisan();
                }else if($utilisateurLambda->getType() == "chefChantier"){
                    $utilisateur = $utilisateurLambda->getChefChantier();
                }
                
                $session->set("typeUtilisateur", $utilisateurLambda->getType());
                $session->set("utilisateur", $utilisateur);
                if ($mdpClair == ""){
                    return $this->redirectToRoute("bl_bi_initialisation", array("id" => $utilisateurLambda->getId()));
                }
                
                
                if ($utilisateurLambda->getType() == "gestionnaire"){
                    return $this->redirectToRoute("bl_bi_gestionnaire_listeArtisans");
                }
                if ($utilisateurLambda->getType() == "chefChantier"){
                    return $this->redirectToRoute("bl_bi_chefChantier_listeChantiers");
                }
                if ($utilisateurLambda->getType() == "artisan"){
                    return $this->redirectToRoute("bl_bi_artisan_listeAffectations");
                }
            }
            
            
            return $this->render('blBiBundle:Connexion:Connexion.html.twig', array('form' => $form->createView()));
        }
        
        return $this->render('blBiBundle:Connexion:Connexion.html.twig', array(
            'form' => $form->createView()));
        
    }
    
    
    public function initialisationAction($id){

        
        $form = $this->createFormBuilder()
                ->add('motDePasse', 'password')
                ->add('verif', 'password')
                ->add('valider', 'submit')
                ->getForm();
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $data = $form->getData();
            // Condition pour la connexion
            // Reste a allez vérifier dans la BDD
            $mdp = $data["motDePasse"] ;
            $verif = $data["verif"] ;
            
            if($mdp = $verif){
                $mdp = md5($mdp);
                $repUtilisateur = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Utilisateur");
                
            
                $session = $this->get("session");
                $type = $session->get("typeUtilisateur") ;
                

                $utilisateur = $repUtilisateur->findOneById($id) ;
                $utilisateur->setMdp($mdp) ;
                $this->getDoctrine()->getManager()->persist($utilisateur);
                $this->getDoctrine()->getManager()->flush();
                
                    if ($type == "gestionnaire"){
                        
                        return $this->redirectToRoute("bl_bi_gestionnaire_listeArtisans");
                    }
                    if ($type == "chefChantier"){
                        
                        return $this->redirectToRoute("bl_bi_chefChantier_listeChantiers");
                    }
                    if ($type == "artisan"){
                        
                        return $this->redirectToRoute("bl_bi_artisan_listeAffectations");
                    }
            }
        }
                        
        return $this->render('blBiBundle:Connexion:Initialisation.html.twig', array(
            'form' => $form->createView()));
        
    }
}
