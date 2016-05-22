<?php

namespace bl\BiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

use bl\BiBundle\Entity\Artisan ;
use bl\BiBundle\Entity\Utilisateur ;
use bl\BiBundle\Entity\Entreprise ;
use bl\BiBundle\Entity\ChefChantier ;

use bl\BiBundle\Form\ArtisanType ;
use bl\BiBundle\Form\EntrepriseType ;
use bl\BiBundle\Form\ChefChantierType ;

class GestionnaireController extends Controller
{
    public function listeArtisansAction(){
        
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $listeArtisan = $repArtisan->findAll() ;
        
        return $this->render('blBiBundle:Body:ListeArtisans.html.twig', array(
            'liste' => $listeArtisan));
        
    }
    
    
    public function ajouterArtisanAction(){
        
        $artisan = new Artisan() ;
        
        $form = $this->createForm(new ArtisanType(), $artisan);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $login = $this->genererLogin($artisan->getNom(), $artisan->getPrenom() ) ;
            $utilisateur = new Utilisateur ;
            $utilisateur->setLogin($login) ;
            $utilisateur->setMdp(md5("")) ;
            $utilisateur->setType("artisan") ;
            $em->persist($utilisateur);
            $artisan->setUtilisateur($utilisateur);
           
            
            $em->persist($artisan);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_gestionnaire_listeArtisans") ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterArtisan.html.twig', array(
            'form' => $form->createView()));
        
    }
    
    public function detailArtisanAction($id){
        
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $artisan = $repArtisan->findOneById($id) ;
        
        return $this->render('blBiBundle:Body:DetailArtisan.html.twig', array(
            'artisan' => $artisan));
        
    }
    
    public function modifierArtisanAction($id){
        
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $artisan = $repArtisan->findOneById($id) ;
        
        $form = $this->createForm(new ArtisanType(), $artisan);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($artisan);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_gestionnaire_listeArtisans") ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterArtisan.html.twig', array(
            'form' => $form->createView()));
        
    }
    

    public function supprimerArtisanAction($id){
        
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $artisan = $repArtisan->findOneById($id) ;
        $utilisateur = $artisan->getutilisateur() ;
        $em = $this->getDoctrine()->getManager();
            
        $em->remove($artisan);
        $em->remove($utilisateur);
        
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_gestionnaire_listeArtisans") ;
        
    }
    
    
    public function listeEntreprisesAction(){
        
        $repEntreprise = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Entreprise");
        $listeEntreprise = $repEntreprise->findAll() ;
        
        return $this->render('blBiBundle:Body:ListeEntreprises.html.twig', array(
            'liste' => $listeEntreprise));
        
    }
    
    public function ajouterEntrepriseAction(){
        
        $entreprise = new Entreprise() ;
        
        $form = $this->createForm(new EntrepriseType(), $entreprise);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            
            
            $em->persist($entreprise);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_gestionnaire_listeEntreprises") ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterEntreprise.html.twig', array(
            'form' => $form->createView()));
        
    }
    
    public function detailEntrepriseAction($id){
        
        $repEntreprise = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Entreprise");
        $entreprise = $repEntreprise->findOneById($id) ;
        
        return $this->render('blBiBundle:Body:DetailEntreprise.html.twig', array(
            'entreprise' => $entreprise));
        
    }
    
    public function modifierEntrepriseAction($id){
        
        $repEntreprise = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Entreprise");
        $entreprise = $repEntreprise->findOneById($id) ;
        
        $form = $this->createForm(new EntrepriseType(), $entreprise);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($entreprise);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_gestionnaire_listeEntreprises") ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterEntreprise.html.twig', array(
            'form' => $form->createView()));
        
    }
    

    public function supprimerEntrepriseAction($id){
        
        $repEntreprise = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Entreprise");
        $entreprise = $repEntreprise->findOneById($id) ;

        $em = $this->getDoctrine()->getManager();
            
        $em->remove($entreprise);

        
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_gestionnaire_listeEntreprises") ;
        
    }
    
    public function ajouterChefChantierAction($id){
        $repEntreprise = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Entreprise");
        $entreprise = $repEntreprise->findOneById($id) ;
        
        
        $chefChantier = new ChefChantier() ;
        
        $form = $this->createForm(new ChefChantierType(), $chefChantier);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
             
            $login = $this->genererLogin($chefChantier->getNom(), $chefChantier->getPrenom() ) ;
            $utilisateur = new Utilisateur ;
            $utilisateur->setLogin($login) ;
            $utilisateur->setMdp(md5("")) ;
            $utilisateur->setType("chefChantier") ;
            $em->persist($utilisateur);
            $chefChantier->setUtilisateur($utilisateur);
           
            $chefChantier->setEntreprise($entreprise);
            
            $em->persist($chefChantier);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_gestionnaire_detailEntreprise", array("id" => $id)) ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterChefChantier.html.twig', array(
            'form' => $form->createView(),
            'id' => $id));
        
    }
    
   
    public function modifierChefChantierAction($id){
        
        $repChefChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:ChefChantier");
        $chefChantier = $repChefChantier->findOneById($id) ;
        
        $form = $this->createForm(new ChefChantierType(), $chefChantier);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($chefChantier);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_gestionnaire_detailEntreprise", array("id" => $chefChantier->getEntreprise()->getId())) ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:AjouterChefChantier.html.twig', array(
            'form' => $form->createView(),
            'id' => $chefChantier->getEntreprise()->getId()));
        
    }
    

    public function supprimerChefChantierAction($id){
        
        $repChefChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:ChefChantier");
        $chefChantier = $repChefChantier->findOneById($id) ;
        $entreprise = $chefChantier->getEntreprise() ;
        $utilisateur = $chefChantier->getutilisateur() ;
        $em = $this->getDoctrine()->getManager();
            
        $em->remove($chefChantier);
        $em->remove($utilisateur);
        
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_gestionnaire_detailEntreprise", array("id" => $entreprise->getId())) ;
        
    }
    
    private function genererLogin($nom, $prenom){
        $repUtilisateur = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Utilisateur");
        
        
        
        $login = substr($prenom, 0, 1).$nom ;
        $login = substr($login, 0, 10) ;
        $i = 0 ;
        $comparaison = true ;
        while($comparaison){
            $utilisateur = $repUtilisateur->findOneByLogin($login) ;
            if ($utilisateur != null){
                $iNbre =  strlen((string) $i) ;
                $login = substr($login, 0, 10 - $iNbre ).$i ;
            }
            else{
                $comparaison = false ;
            }
        }
               
        return $login ;
    }
    
    
}
