<?php

namespace bl\BiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChefChantier
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="bl\BiBundle\Entity\ChefChantierRepository")
 */
class ChefChantier
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
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;


    /**
     *
     * @ORM\OneToOne(targetEntity="bl\BiBundle\Entity\Utilisateur", inversedBy="chefChantier")
     */
    private $utilisateur;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="bl\BiBundle\Entity\Entreprise", inversedBy="chefChantier")
     */
    private $entreprise;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="bl\BiBundle\Entity\Chantier", mappedBy="chefChantier")
     */
    private $chantiers;
    
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
     * @return ChefChantier
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
     * @return ChefChantier
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
     * Constructor
     */
    public function __construct()
    {
        $this->chantiers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set utilisateur
     *
     * @param \blBiBundle\Entity\Utilisateur $utilisateur
     * @return ChefChantier
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
     * Add chantiers
     *
     * @param \blBiBundle\Entity\Chantier $chantiers
     * @return ChefChantier
     */
    public function addChantier(\bl\BiBundle\Entity\Chantier $chantiers)
    {
        $this->chantiers[] = $chantiers;

        return $this;
    }

    /**
     * Remove chantiers
     *
     * @param \blBiBundle\Entity\Chantier $chantiers
     */
    public function removeChantier(\bl\BiBundle\Entity\Chantier $chantiers)
    {
        $this->chantiers->removeElement($chantiers);
    }

    /**
     * Get chantiers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChantiers()
    {
        return $this->chantiers;
    }

    /**
     * Set entreprise
     *
     * @param \blBiBundle\Entity\Entreprise $entreprise
     * @return ChefChantier
     */
    public function setEntreprise(\bl\BiBundle\Entity\Entreprise $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \blBiBundle\Entity\Entreprise 
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }
}
