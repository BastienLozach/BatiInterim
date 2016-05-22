<?php

namespace bl\BiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="bl\BiBundle\Entity\UtilisateurRepository")
 */
class Utilisateur
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
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;


    /**
     *
     * @ORM\OneToOne(targetEntity="bl\BiBundle\Entity\Gestionnaire", mappedBy="utilisateur")
     */
    private $gestionnaire;
    
        /**
     *
     * @ORM\OneToOne(targetEntity="bl\BiBundle\Entity\Artisan", mappedBy="utilisateur")
     */
    private $artisan;
    
        /**
     *
     * @ORM\OneToOne(targetEntity="bl\BiBundle\Entity\ChefChantier", mappedBy="utilisateur")
     */
    private $chefChantier;
    
    
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
     * Set login
     *
     * @param string $login
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set mdp
     *
     * @param string $mdp
     * @return Utilisateur
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string 
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Utilisateur
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set gestionnaire
     *
     * @param \blBiBundle\Entity\Gestionnaire $gestionnaire
     * @return Utilisateur
     */
    public function setGestionnaire(\bl\BiBundle\Entity\Gestionnaire $gestionnaire = null)
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    /**
     * Get gestionnaire
     *
     * @return \blBiBundle\Entity\Gestionnaire 
     */
    public function getGestionnaire()
    {
        return $this->gestionnaire;
    }

    /**
     * Set artisan
     *
     * @param \blBiBundle\Entity\Artisan $artisan
     * @return Utilisateur
     */
    public function setArtisan(\bl\BiBundle\Entity\Artisan $artisan = null)
    {
        $this->artisan = $artisan;

        return $this;
    }

    /**
     * Get artisan
     *
     * @return \blBiBundle\Entity\Artisan 
     */
    public function getArtisan()
    {
        return $this->artisan;
    }

    /**
     * Set chefChantier
     *
     * @param \blBiBundle\Entity\ChefChantier $chefChantier
     * @return Utilisateur
     */
    public function setChefChantier(\bl\BiBundle\Entity\ChefChantier $chefChantier = null)
    {
        $this->chefChantier = $chefChantier;

        return $this;
    }

    /**
     * Get chefChantier
     *
     * @return \blBiBundle\Entity\ChefChantier 
     */
    public function getChefChantier()
    {
        return $this->chefChantier;
    }
}
