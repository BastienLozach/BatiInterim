<?php

namespace bl\BiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;




use bl\BiBundle\Entity\Affectation ;
use bl\BiBundle\Entity\Artisan ;
use bl\BiBundle\Entity\Conge ;

use bl\BiBundle\Form\ArtisanType ;
use bl\BiBundle\Form\CongeType ;

class ArtisanController extends Controller
{

    public function listeAffectationsAction(){
        
        $repAffectation = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Affectation");
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        
        $session = $this->get("session");
        $artisan = $session->get("utilisateur") ;
        
        $listeAffectation = $repAffectation->findByArtisan($artisan) ;
        
        return $this->render('blBiBundle:Body:ListeAffectationsArtisan.html.twig', array(
            'liste' => $listeAffectation
        ));
        
    }
    
    
    public function accepterAffectationAction($id){
        $repAffectation = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Affectation");
        $affectation = $repAffectation->findOneById($id) ;
        $affectation->setStatut("acceptee") ;
        
        $em = $this->getDoctrine()->getManager();
            
        $em->persist($affectation);
                
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_artisan_listeAffectations") ;
    }
    
    
    
    public function refuserAffectationAction($id){
        
        $repAffectation = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Affectation");
        $affectation = $repAffectation->findOneById($id) ;
        $affectation->setStatut("refusee") ;
        
        $em = $this->getDoctrine()->getManager();
            
        $em->persist($affectation);
                
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_artisan_listeAffectations") ;
        
    }
    
    public function detailChantierAction($id){
        
        $repChantier = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Chantier");
        $chantier = $repChantier->findOneById($id) ;
        
        return $this->render('blBiBundle:Body:DetailChantierArtisan.html.twig', array(
            'chantier' => $chantier));
        
    }
    
    
    public function modifierArtisanAction(){
        $session = $this->get("session");
        $id = $session->get("utilisateur")->getId() ;
        
        
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        $artisan = $repArtisan->findOneById($id) ;
        
        $form = $this->createForm(new ArtisanType(), $artisan);
        
        $request = $this->container->get('request');
        $form->handleRequest($request);
        
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($artisan);
            $em->flush();
            
            return $this->redirectToRoute("bl_bi_artisan_listeAffectations") ;
        }
                  
        
        
        
        return $this->render('blBiBundle:Body:ModifierArtisan.html.twig', array(
            'form' => $form->createView()));
        
    }
    
    public function listeCongesAction($mois, $annee){
        $now = new \DateTime() ;
        if ($mois === null){
            $mois = $now->format('m');
        }
        if ($annee === null){
            $annee = $now->format('y');
        }
        
        if ($mois > 12){
            $mois -= 12 ;
            $annee += 1 ;
        }
        if ($mois <= 0){
            $mois += 12 ;
            $annee -= 1 ;
        }
        
        
        $session = $this->get("session");
        $artisan = $session->get("utilisateur") ;
        
        $debut = new \DateTime(sprintf("%04d-%02d-01", $annee, $mois)) ;
        
        $fin = new \DateTime(sprintf("%04d-%02d-01", $annee, $mois)) ;
        $fin->modify('+1 month');
        //$fin->modify('-1 day');
        
        $periode = new \DatePeriod($debut,  new \DateInterval('P1D'),$fin );
        
        $repConge = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Conge");
        $repArtisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan");
        
        
        $calendrier = array();
        
        
        
        foreach($periode as $jour){
            $data = array();
            $data["jour"] = $jour->format('d');
            $data["jourSemaine"] = $jour->format('N');
            $data["conge"] = null ;
            
            if ($jour->format("y-m-d") <= $now->format("y-m-d")){
                $data["disponible"] = false ;
                $data["conge"] = null ;
            }
            else {
                $data["disponible"] = $repArtisan->disponibleParDateEtArtisan($jour, $artisan) ;
                $conge = $repConge->findOneBy(array("artisan" => $artisan, "dateConge" => $jour)) ;
                $data["conge"] = $conge ;
//                if ($conge !== null) {
//                    $data["conge"] = $conge ;
//                }
            }
            array_push($calendrier, $data);
        }
        
        return $this->render('blBiBundle:Body:Conges.html.twig', array(
            'mois' => $mois+1-1,
            'annee' => $annee,
            'calendrier' => $calendrier
        ));
        
    }
    
    public function supprimerCongeAction($id){
        
        $repConge = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Conge");
        $conge = $repConge->findOneById($id) ;
        
        
        $em = $this->getDoctrine()->getManager();
            
        $em->remove($conge);
                
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_artisan_listeConges") ;
        
    }
    
    public function ajouterCongeAction($jour, $mois, $annee){
        $date = new \DateTime(sprintf("%04d-%02d-%02d", $annee, $mois, $jour));
        
        $conge = new Conge() ;
        $conge->setDateConge($date) ;
        
        $session = $this->get("session");
        $id = $session->get("utilisateur")->getId() ;
        
        $artisan = $this->getDoctrine()->getManager()->getRepository("blBiBundle:Artisan")->findOneById($id);
        
        $conge->setArtisan($artisan);
        $conge->setEtat("propose");
        
        $em = $this->getDoctrine()->getManager();
            
        $em->persist($conge);
                
        $em->flush();
        
        return $this->redirectToRoute("bl_bi_artisan_listeConges", array("mois" => $mois, "annee" => $annee)) ;
    }
}
