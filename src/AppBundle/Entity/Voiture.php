<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VoitureRepository")
 */
class Voiture
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
     * @ORM\ManyToOne(targetEntity="Marque_Voiture")
     */
    private $marque;

    /**
     *@ORM\ManyToOne(targetEntity="Modele_Voiture")
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="pays_immatriculation", type="string", length=255)
     */
    private $paysImmatriculation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_immatriculation", type="datetime")
     */
    private $dateImmatriculation;

    /**
     * @var string
     *
     * @ORM\Column(name="nb_places", type="string", length=255)
     */
    private $nbPlaces;

    /**
     * @var string
     *
     * @ORM\Column(name="nb_portes", type="string", length=255)
     */
    private $nbPortes;

    /**
     * @var string
     *
     * @ORM\Column(name="carburant", type="string", length=255)
     */
    private $carburant;

    /**
     * @var string
     *
     * @ORM\Column(name="boite_vitesse", type="string", length=255)
     */
    private $boiteVitesse;

    /**
     * @var string
     *
     * @ORM\Column(name="km_parcourus", type="string", length=255)
     */
    private $kmParcourus;

    /**
     * @var string
     *
     * @ORM\Column(name="conso_carburant", type="string", length=255)
     */
    private $consoCarburant;

    /**
     * @var array
     *
     * @ORM\Column(name="options", type="simple_array")
     */
    private $options;


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
     * Set paysImmatriculation
     *
     * @param string $paysImmatriculation
     *
     * @return Voiture
     */
    public function setPaysImmatriculation($paysImmatriculation)
    {
        $this->paysImmatriculation = $paysImmatriculation;

        return $this;
    }

    /**
     * Get paysImmatriculation
     *
     * @return string
     */
    public function getPaysImmatriculation()
    {
        return $this->paysImmatriculation;
    }

    /**
     * Set dateImmatriculation
     *
     * @param \DateTime $dateImmatriculation
     *
     * @return Voiture
     */
    public function setDateImmatriculation($dateImmatriculation)
    {
        $this->dateImmatriculation = $dateImmatriculation;

        return $this;
    }

    /**
     * Get dateImmatriculation
     *
     * @return \DateTime
     */
    public function getDateImmatriculation()
    {
        return $this->dateImmatriculation;
    }

    /**
     * Set nbPlaces
     *
     * @param string $nbPlaces
     *
     * @return Voiture
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * Get nbPlaces
     *
     * @return string
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * Set nbPortes
     *
     * @param string $nbPortes
     *
     * @return Voiture
     */
    public function setNbPortes($nbPortes)
    {
        $this->nbPortes = $nbPortes;

        return $this;
    }

    /**
     * Get nbPortes
     *
     * @return string
     */
    public function getNbPortes()
    {
        return $this->nbPortes;
    }

    /**
     * Set carburant
     *
     * @param string $carburant
     *
     * @return Voiture
     */
    public function setCarburant($carburant)
    {
        $this->carburant = $carburant;

        return $this;
    }

    /**
     * Get carburant
     *
     * @return string
     */
    public function getCarburant()
    {
        return $this->carburant;
    }

    /**
     * Set boiteVitesse
     *
     * @param string $boiteVitesse
     *
     * @return Voiture
     */
    public function setBoiteVitesse($boiteVitesse)
    {
        $this->boiteVitesse = $boiteVitesse;

        return $this;
    }

    /**
     * Get boiteVitesse
     *
     * @return string
     */
    public function getBoiteVitesse()
    {
        return $this->boiteVitesse;
    }

    /**
     * Set kmParcourus
     *
     * @param string $kmParcourus
     *
     * @return Voiture
     */
    public function setKmParcourus($kmParcourus)
    {
        $this->kmParcourus = $kmParcourus;

        return $this;
    }

    /**
     * Get kmParcourus
     *
     * @return string
     */
    public function getKmParcourus()
    {
        return $this->kmParcourus;
    }

    /**
     * Set consoCarburant
     *
     * @param string $consoCarburant
     *
     * @return Voiture
     */
    public function setConsoCarburant($consoCarburant)
    {
        $this->consoCarburant = $consoCarburant;

        return $this;
    }

    /**
     * Get consoCarburant
     *
     * @return string
     */
    public function getConsoCarburant()
    {
        return $this->consoCarburant;
    }

    /**
     * Set options
     *
     * @param array $options
     *
     * @return Voiture
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set marque
     *
     * @param \AppBundle\Entity\Marque_Voiture $marque
     *
     * @return Voiture
     */
    public function setMarque(\AppBundle\Entity\Marque_Voiture $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \AppBundle\Entity\Marque_Voiture
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param \AppBundle\Entity\Modele_Voiture $modele
     *
     * @return Voiture
     */
    public function setModele(\AppBundle\Entity\Modele_Voiture $modele = null)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return \AppBundle\Entity\Modele_Voiture
     */
    public function getModele()
    {
        return $this->modele;
    }
}
