<?php

namespace bl\BiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gestionnaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="bl\BiBundle\Entity\GestionnaireRepository")
 */
class Gestionnaire
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
     *
     * @ORM\OneToOne(targetEntity="bl\BiBundle\Entity\Utilisateur", inversedBy="gestionnaire")
     */
    private $utilisateur;

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
     * @return Gestionnaire
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
     * Set utilisateur
     *
     * @param \blBiBundle\Entity\Utilisateur $utilisateur
     * @return Gestionnaire
     */
    public function setUtilisateur(\blBiBundle\Entity\Utilisateur $utilisateur = null)
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
}
