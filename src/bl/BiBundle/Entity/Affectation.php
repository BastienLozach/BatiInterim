<?php

namespace bl\BiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="bl\BiBundle\Entity\AffectationRepository")
 */
class Affectation
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
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAffectation", type="date")
     */
    private $dateAffectation;

    /**
     *
     * @ORM\ManyToOne(targetEntity="bl\BiBundle\Entity\Artisan", inversedBy="affectations")
     */
    private $artisan ;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="bl\BiBundle\Entity\Mission", inversedBy="affectations")
     */
    private $mission ;
    

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
     * Set statut
     *
     * @param string $statut
     * @return Affectation
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set dateAffectation
     *
     * @param \DateTime $dateAffectation
     * @return Affectation
     */
    public function setDateAffectation($dateAffectation)
    {
        $this->dateAffectation = $dateAffectation;

        return $this;
    }

    /**
     * Get dateAffectation
     *
     * @return \DateTime 
     */
    public function getDateAffectation()
    {
        return $this->dateAffectation;
    }

    /**
     * Set artisan
     *
     * @param \blBiBundle\Entity\Artisan $artisan
     * @return Affectation
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
     * Set mission
     *
     * @param \blBiBundle\Entity\Mission $mission
     * @return Affectation
     */
    public function setMission(\bl\BiBundle\Entity\Mission $mission = null)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return \blBiBundle\Entity\Mission 
     */
    public function getMission()
    {
        return $this->mission;
    }
}
