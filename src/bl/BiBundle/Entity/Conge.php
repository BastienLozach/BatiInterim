<?php

namespace bl\BiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conge
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="bl\BiBundle\Entity\CongeRepository")
 */
class Conge
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateConge", type="date")
     */
    private $dateConge;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     *
     * @ORM\ManyToOne(targetEntity="bl\BiBundle\Entity\Artisan", inversedBy="conges")
     */
    private $artisan ;

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
     * Set dateConge
     *
     * @param \DateTime $dateConge
     * @return Conge
     */
    public function setDateConge($dateConge)
    {
        $this->dateConge = $dateConge;

        return $this;
    }

    /**
     * Get dateConge
     *
     * @return \DateTime 
     */
    public function getDateConge()
    {
        return $this->dateConge;
    }

    /**
     * Set etat
     *
     * @param string $etat
     * @return Conge
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set artisan
     *
     * @param \bl\BiBundle\Entity\Artisan $artisan
     * @return Conge
     */
    public function setArtisan(\bl\BiBundle\Entity\Artisan $artisan = null)
    {
        $this->artisan = $artisan;

        return $this;
    }

    /**
     * Get artisan
     *
     * @return \bl\BiBundle\Entity\Artisan 
     */
    public function getArtisan()
    {
        return $this->artisan;
    }
}
