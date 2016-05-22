<?php

namespace bl\BiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chantier
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="bl\BiBundle\Entity\ChantierRepository")
 */
class Chantier
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;

    
     /**
     *
     * @ORM\ManyToOne(targetEntity="bl\BiBundle\Entity\ChefChantier", inversedBy="chantiers")
     */
    private $chefChantier;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="bl\BiBundle\Entity\Mission", mappedBy="chantier")
     */
    private $missions;

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
     * @return Chantier
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Chantier
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Chantier
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set chefChantier
     *
     * @param \blBiBundle\Entity\ChefChantier $chefChantier
     * @return Chantier
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->missions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add missions
     *
     * @param \blBiBundle\Entity\ $missions
     * @return Chantier
     */
    public function addMission(\bl\BiBundle\Entity\Mission $missions)
    {
        $this->missions[] = $missions;

        return $this;
    }

    /**
     * Remove missions
     *
     * @param \bl\BiBundle\Entity\ $missions
     */
    public function removeMission(\bl\BiBundle\Entity\Mission $missions)
    {
        $this->missions->removeElement($missions);
    }

    /**
     * Get missions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMissions()
    {
        return $this->missions;
    }
}
