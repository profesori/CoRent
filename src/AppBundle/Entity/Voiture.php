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
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="MarqueVoiture")
     */
    private $marque;
    /**
     * @var string
     *
     * @ORM\Column(name="annee_production", type="string", length=4)
     */
    private $anneeProduction;
    /**
     * @ORM\ManyToOne(targetEntity="ModeleVoiture")
     */
    private $modele;
    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=255,nullable=true)
     */
    private $details;
    /**
    * @ORM\ManyToOne(targetEntity="Dico")
    */
    private $portes;
   /**
   * @ORM\ManyToOne(targetEntity="Dico")
   */
    private $places;
    /**
    * @ORM\ManyToOne(targetEntity="Dico")
    */
    private $carburant;
     /**
     * @ORM\ManyToOne(targetEntity="Dico")
     */
    private $boite;
      /**
      * @ORM\ManyToOne(targetEntity="Dico")
      */
    private $kmParcourues;
    /**
     * @ORM\ManyToMany(targetEntity="Dico")
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
     * Set marque
     *
     * @param string $marque
     *
     * @return Voiture
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return Voiture
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return Voiture
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set portes
     *
     * @param \AppBundle\Entity\Dico $portes
     *
     * @return Voiture
     */
    public function setPortes(\AppBundle\Entity\Dico $portes = null)
    {
        $this->portes = $portes;

        return $this;
    }

    /**
     * Get portes
     *
     * @return \AppBundle\Entity\Dico
     */
    public function getPortes()
    {
        return $this->portes;
    }

    /**
     * Set places
     *
     * @param \AppBundle\Entity\Dico $places
     *
     * @return Voiture
     */
    public function setPlaces(\AppBundle\Entity\Dico $places = null)
    {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return \AppBundle\Entity\Dico
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set carburant
     *
     * @param \AppBundle\Entity\Dico $carburant
     *
     * @return Voiture
     */
    public function setCarburant(\AppBundle\Entity\Dico $carburant = null)
    {
        $this->carburant = $carburant;

        return $this;
    }

    /**
     * Get carburant
     *
     * @return \AppBundle\Entity\Dico
     */
    public function getCarburant()
    {
        return $this->carburant;
    }

    /**
     * Set boite
     *
     * @param \AppBundle\Entity\Dico $boite
     *
     * @return Voiture
     */
    public function setBoite(\AppBundle\Entity\Dico $boite = null)
    {
        $this->boite = $boite;

        return $this;
    }

    /**
     * Get boite
     *
     * @return \AppBundle\Entity\Dico
     */
    public function getBoite()
    {
        return $this->boite;
    }

    /**
     * Set kmParcourues
     *
     * @param \AppBundle\Entity\Dico $kmParcourues
     *
     * @return Voiture
     */
    public function setKmParcourues(\AppBundle\Entity\Dico $kmParcourues = null)
    {
        $this->kmParcourues = $kmParcourues;

        return $this;
    }

    /**
     * Get kmParcourues
     *
     * @return \AppBundle\Entity\Dico
     */
    public function getKmParcourues()
    {
        return $this->kmParcourues;
    }

    /**
     * Add option
     *
     * @param \AppBundle\Entity\Dico $option
     *
     * @return Voiture
     */
    public function addOption(\AppBundle\Entity\Dico $option)
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     * Remove option
     *
     * @param \AppBundle\Entity\Dico $option
     */
    public function removeOption(\AppBundle\Entity\Dico $option)
    {
        $this->options->removeElement($option);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get modele
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set modele
     *
     * @param \AppBundle\Entity\ModeleVoiture $modele
     *
     * @return Voiture
     */
    public function setModele(\AppBundle\Entity\ModeleVoiture $modele = null)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Set anneeProduction
     *
     * @param string $anneeProduction
     *
     * @return Voiture
     */
    public function setAnneeProduction($anneeProduction)
    {
        $this->anneeProduction = $anneeProduction;

        return $this;
    }

    /**
     * Get anneeProduction
     *
     * @return string
     */
    public function getAnneeProduction()
    {
        return $this->anneeProduction;
    }
}
