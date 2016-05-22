<?php

namespace bl\BiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="bl\BiBundle\Entity\EntrepriseRepository")
 */
class Entreprise
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=6)
     */
    private $cp;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="bl\BiBundle\Entity\ChefChantier", mappedBy="entreprise")
     */
    private $chefChantier;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="bl\BiBundle\Entity\Secteur")
     */
    private $secteur;
    

    

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
     * @return Entreprise
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
     * Set telephone
     *
     * @param string $telephone
     * @return Entreprise
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Entreprise
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
     * Set ville
     *
     * @param string $ville
     * @return Entreprise
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Entreprise
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chefChantier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set secteur
     *
     * @param \blBiBundle\Entity\Secteur $secteur
     * @return Entreprise
     */
    public function setSecteur(\bl\BiBundle\Entity\Secteur $secteur = null)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur
     *
     * @return \blBiBundle\Entity\Secteur 
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Add chefChantier
     *
     * @param \blBiBundle\Entity\ChefChantier $chefChantier
     * @return Entreprise
     */
    public function addChefChantier(\bl\BiBundle\Entity\ChefChantier $chefChantier)
    {
        $this->chefChantier[] = $chefChantier;

        return $this;
    }

    /**
     * Remove chefChantier
     *
     * @param \blBiBundle\Entity\ChefChantier $chefChantier
     */
    public function removeChefChantier(\bl\BiBundle\Entity\ChefChantier $chefChantier)
    {
        $this->chefChantier->removeElement($chefChantier);
    }

    /**
     * Get chefChantier
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChefChantier()
    {
        return $this->chefChantier;
    }
}
