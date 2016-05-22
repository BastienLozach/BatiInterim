<?php

namespace bl\BiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artisan
 *
 * @ORM\Table(name="artisan")
 * @ORM\Entity(repositoryClass="bl\BiBundle\Entity\ArtisanRepository")
 */
class Artisan
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text", nullable=false)
     */
    private $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=false)
     */
    private $datenaissance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEmbauche", type="date", nullable=false)
     */
    private $dateembauche;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;

    /**
     *
     * @ORM\OneToOne(targetEntity="bl\BiBundle\Entity\Utilisateur", inversedBy="artisan")
     */
    private $utilisateur;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="bl\BiBundle\Entity\CorpsMetier")
     */
    private $corpsMetier ;

    /**
     *
     * @ORM\OneToMany(targetEntity="bl\BiBundle\Entity\Affectation", mappedBy="artisan")
     */
    private $affectations ;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="bl\BiBundle\Entity\Conge", mappedBy="artisan")
     */
    private $conges ;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Artisan
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Artisan
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Artisan
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     * @return Artisan
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime 
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set dateembauche
     *
     * @param \DateTime $dateembauche
     * @return Artisan
     */
    public function setDateembauche($dateembauche)
    {
        $this->dateembauche = $dateembauche;

        return $this;
    }

    /**
     * Get dateembauche
     *
     * @return \DateTime 
     */
    public function getDateembauche()
    {
        return $this->dateembauche;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Artisan
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set utilisateur
     *
     * @param \blBiBundle\Entity\Utilisateur $utilisateur
     * @return Artisan
     */
    public function setUtilisateur(\bl\BiBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \blBiBundle\Entity\Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->affectations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set corpsMetier
     *
     * @param \blBiBundle\Entity\CorpsMetier $corpsMetier
     * @return Artisan
     */
    public function setCorpsMetier(\bl\BiBundle\Entity\CorpsMetier $corpsMetier = null)
    {
        $this->corpsMetier = $corpsMetier;

        return $this;
    }

    /**
     * Get corpsMetier
     *
     * @return \blBiBundle\Entity\CorpsMetier 
     */
    public function getCorpsMetier()
    {
        return $this->corpsMetier;
    }

    /**
     * Add affectations
     *
     * @param \blBiBundle\Entity\Affectation $affectations
     * @return Artisan
     */
    public function addAffectation(\bl\BiBundle\Entity\Affectation $affectations)
    {
        $this->affectations[] = $affectations;

        return $this;
    }

    /**
     * Remove affectations
     *
     * @param \blBiBundle\Entity\Affectation $affectations
     */
    public function removeAffectation(\bl\BiBundle\Entity\Affectation $affectations)
    {
        $this->affectations->removeElement($affectations);
    }

    /**
     * Get affectations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAffectations()
    {
        return $this->affectations;
    }

    /**
     * Add conges
     *
     * @param \bl\BiBundle\Entity\Conge $conges
     * @return Artisan
     */
    public function addConge(\bl\BiBundle\Entity\Conge $conges)
    {
        $this->conges[] = $conges;

        return $this;
    }

    /**
     * Remove conges
     *
     * @param \bl\BiBundle\Entity\Conge $conges
     */
    public function removeConge(\bl\BiBundle\Entity\Conge $conges)
    {
        $this->conges->removeElement($conges);
    }

    /**
     * Get conges
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConges()
    {
        return $this->conges;
    }
}
