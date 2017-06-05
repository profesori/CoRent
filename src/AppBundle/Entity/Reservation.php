<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
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
     *
     * @ORM\Column(name="dateReservation", type="datetime")
     */
    private $dateReservation;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime")
     */
    private $dateFin;

    /**
     * @var int
     *
     * @ORM\Column(name="KM", type="integer",nullable=true)
     */
    private $kM;

    /**
     * @var int
     *
     * @ORM\Column(name="Prix", type="integer")
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="reduction", type="integer")
     */
    private $reduction;
    /**
    * @ORM\OneToOne(targetEntity="DemandesAnnonce",mappedBy="reservation")
    */
    private $demandeAnnonce;



    public function getAnnonce()
    {
        return $this->getDemandeAnnonce()->getAnnonce();
    }

    public function getPrixLocataire()
    {
        return $this->getPrix()-($this->getPrix()*0.3);
    }

    public function getLoueur()
    {
        $this->getAnnonce()->getLoueur()->getEmri();
    }

    public function getLocataire()
    {
        $this->getDemandeAnnonce()->getLocataire()->getEmri();
    }


    /**
     * @ORM\PrePersist
     */
    public function updateDate()
    {
        $this->setDateReservation(new \Datetime());
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Reservation
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
     *
     * @return Reservation
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
     * Set kM
     *
     * @param integer $kM
     *
     * @return Reservation
     */
    public function setKM($kM)
    {
        $this->kM = $kM;

        return $this;
    }

    /**
     * Get kM
     *
     * @return int
     */
    public function getKM()
    {
        return $this->kM;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Reservation
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set reduction
     *
     * @param integer $reduction
     *
     * @return Reservation
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;

        return $this;
    }

    /**
     * Get reduction
     *
     * @return int
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set demandeAnnonce
     *
     * @param \AppBundle\Entity\DemandesAnnonce $demandeAnnonce
     *
     * @return Reservation
     */
    public function setDemandeAnnonce(\AppBundle\Entity\DemandesAnnonce $demandeAnnonce = null)
    {
        $this->demandeAnnonce = $demandeAnnonce;
        $demandeAnnonce->setReservation($this);
        return $this;
    }

    /**
     * Get demandeAnnonce
     *
     * @return \AppBundle\Entity\DemandesAnnonce
     */
    public function getDemandeAnnonce()
    {
        return $this->demandeAnnonce;
    }
}
