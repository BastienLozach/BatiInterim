<?php

namespace bl\BiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mission
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="bl\BiBundle\Entity\MissionRepository")
 */
class Mission
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
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbreArtisans", type="integer")
     */
    private $nbreArtisans;

    /**
     * @var string
     *
     * @ORM\Column(name="prixJournalier", type="decimal")
     */
    private $prixJournalier;

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
     * @ORM\ManyToOne(targetEntity="bl\BiBundle\Entity\Chantier", inversedBy="missions")
     */
    private $chantier;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="bl\BiBundle\Entity\CorpsMetier")
     */
    private $corpsMetier ;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="bl\BiBundle\Entity\Affectation", mappedBy="mission")
     */
    private $affectations ;
    
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
     * Set intitule
     *
     * @param string $intitule
     * @return Mission
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set nbreArtisans
     *
     * @param integer $nbreArtisans
     * @return Mission
     */
    public function setNbreArtisans($nbreArtisans)
    {
        $this->nbreArtisans = $nbreArtisans;

        return $this;
    }

    /**
     * Get nbreArtisans
     *
     * @return integer 
     */
    public function getNbreArtisans()
    {
        return $this->nbreArtisans;
    }

    /**
     * Set prixJournalier
     *
     * @param string $prixJournalier
     * @return Mission
     */
    public function setPrixJournalier($prixJournalier)
    {
        $this->prixJournalier = $prixJournalier;

        return $this;
    }

    /**
     * Get prixJournalier
     *
     * @return string 
     */
    public function getPrixJournalier()
    {
        return $this->prixJournalier;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Mission
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
     * @return Mission
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
     * Constructor
     */
    public function __construct()
    {
        $this->affectations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set chantier
     *
     * @param \blBiBundle\Entity\chantier $chantier
     * @return Mission
     */
    public function setChantier(\bl\BiBundle\Entity\chantier $chantier = null)
    {
        $this->chantier = $chantier;

        return $this;
    }

    /**
     * Get chantier
     *
     * @return \blBiBundle\Entity\chantier 
     */
    public function getChantier()
    {
        return $this->chantier;
    }

    /**
     * Set corpsMetier
     *
     * @param \blBiBundle\Entity\CorpsMetier $corpsMetier
     * @return Mission
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
     * @return Mission
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
}
