<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    * Many Calendrier have One Annonce.
    * @ORM\ManyToOne(targetEntity="Marque_Voiture", inversedBy="$calendrier")
    */
    private $annonce;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_indisponible", type="date")
     */
    private $dateIndisponible;


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
     * Set annonce
     *
     * @param string $annonce
     *
     * @return Calendrier
     */
    public function setAnnonce($annonce)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return string
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    /**
     * Set dateIndisponible
     *
     * @param \DateTime $dateIndisponible
     *
     * @return Calendrier
     */
    public function setDateIndisponible($dateIndisponible)
    {
        $this->dateIndisponible = $dateIndisponible;

        return $this;
    }

    /**
     * Get dateIndisponible
     *
     * @return \DateTime
     */
    public function getDateIndisponible()
    {
        return $this->dateIndisponible;
    }
}
