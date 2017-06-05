<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Calendrier
 *
 * @ORM\Table(name="calendrier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CalendrierRepository")
 */
class Calendrier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *@Assert\Date(message="Data nuk eshte korrekte")
     * @ORM\Column(name="dateStatus", type="date")
     */
    private $dateStatus;

    /**
     * @var bool
     *
     * @ORM\Column(name="isFree", type="boolean")
     */
    private $isFree;

    /**
     * @var \DateTime
     *@Assert\Date(message="Data nuk eshte korrekte")
     * @ORM\Column(name="dateModification", type="date")
     */
    private $dateModification;
    /**
    * @ORM\ManyToOne(targetEntity="Annonce", inversedBy="calendrier")
    */
   private $annonce;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateStatus
     *
     * @param \DateTime $dateStatus
     *
     * @return Calendrier
     */
    public function setDateStatus($dateStatus)
    {
        $this->dateStatus = $dateStatus;

        return $this;
    }

    /**
     * Get dateStatus
     *
     * @return \DateTime
     */
    public function getDateStatus()
    {
        return $this->dateStatus;
    }

    /**
     * Set isFree
     *
     * @param boolean $isFree
     *
     * @return Calendrier
     */
    public function setIsFree($isFree)
    {
        $this->isFree = $isFree;

        return $this;
    }

    /**
     * Get isFree
     *
     * @return bool
     */
    public function getIsFree()
    {
        return $this->isFree;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Calendrier
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set annonce
     *
     * @param \AppBundle\Entity\Annonce $annonce
     *
     * @return Calendrier
     */
    public function setAnnonce(\AppBundle\Entity\Annonce $annonce = null)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \AppBundle\Entity\Annonce
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }
}
