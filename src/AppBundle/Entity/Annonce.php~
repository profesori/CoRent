<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnnonceRepository")
 */
class Annonce
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
     * @var string
     *
     * @ORM\Column(name="voiture", type="string", length=255)
     */
    private $voiture;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_jour", type="integer")
     */
    private $prixJour;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_km", type="float")
     */
    private $prixKm;
    /**
     * @var string
     *
     * @ORM\Column(name="horaires_dispo", type="string",length=255)
     */
    private $horaires_dispo;
    /**
     * One Annonce has Many Calendrier.
     * @ORM\OneToMany(targetEntity="Calendrier", mappedBy="$annonce")
     */
     private $calendrier;


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
     * Set voiture
     *
     * @param string $voiture
     *
     * @return Annonce
     */
    public function setVoiture($voiture)
    {
        $this->voiture = $voiture;

        return $this;
    }

    /**
     * Get voiture
     *
     * @return string
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Annonce
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set prixJour
     *
     * @param integer $prixJour
     *
     * @return Annonce
     */
    public function setPrixJour($prixJour)
    {
        $this->prixJour = $prixJour;

        return $this;
    }

    /**
     * Get prixJour
     *
     * @return int
     */
    public function getPrixJour()
    {
        return $this->prixJour;
    }

    /**
     * Set prixKm
     *
     * @param float $prixKm
     *
     * @return Annonce
     */
    public function setPrixKm($prixKm)
    {
        $this->prixKm = $prixKm;

        return $this;
    }

    /**
     * Get prixKm
     *
     * @return float
     */
    public function getPrixKm()
    {
        return $this->prixKm;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->calendrier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set horairesDispo
     *
     * @param string $horairesDispo
     *
     * @return Annonce
     */
    public function setHorairesDispo($horairesDispo)
    {
        $this->horaires_dispo = $horairesDispo;

        return $this;
    }

    /**
     * Get horairesDispo
     *
     * @return string
     */
    public function getHorairesDispo()
    {
        return $this->horaires_dispo;
    }

    /**
     * Add calendrier
     *
     * @param \AppBundle\Entity\Calendrier $calendrier
     *
     * @return Annonce
     */
    public function addCalendrier(\AppBundle\Entity\Calendrier $calendrier)
    {
        $this->calendrier[] = $calendrier;

        return $this;
    }

    /**
     * Remove calendrier
     *
     * @param \AppBundle\Entity\Calendrier $calendrier
     */
    public function removeCalendrier(\AppBundle\Entity\Calendrier $calendrier)
    {
        $this->calendrier->removeElement($calendrier);
    }

    /**
     * Get calendrier
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCalendrier()
    {
        return $this->calendrier;
    }
}
