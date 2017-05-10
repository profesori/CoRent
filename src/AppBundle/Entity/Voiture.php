<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="CorentApi\ApiBundle\Repository\VoitureRepository")
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
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;
    /**
     * @ORM\OneToMany(targetEntity="ModeleVoiture", mappedBy="marque")
     */
    private $modeles;
    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=255)
     */
    private $details;
    /**
     * @var string
     *
     * @ORM\Column(name="commentaires", type="string", length=255)
     */
    private $commentaires;
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
        $this->modeles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add modele
     *
     * @param \CorentApi\ApiBundle\Entity\ModeleVoiture $modele
     *
     * @return Voiture
     */
    public function addModele(\CorentApi\ApiBundle\Entity\ModeleVoiture $modele)
    {
        $this->modeles[] = $modele;

        return $this;
    }

    /**
     * Remove modele
     *
     * @param \CorentApi\ApiBundle\Entity\ModeleVoiture $modele
     */
    public function removeModele(\CorentApi\ApiBundle\Entity\ModeleVoiture $modele)
    {
        $this->modeles->removeElement($modele);
    }

    /**
     * Get modeles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModeles()
    {
        return $this->modeles;
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
     * @param \CorentApi\ApiBundle\Entity\Dico $portes
     *
     * @return Voiture
     */
    public function setPortes(\CorentApi\ApiBundle\Entity\Dico $portes = null)
    {
        $this->portes = $portes;

        return $this;
    }

    /**
     * Get portes
     *
     * @return \CorentApi\ApiBundle\Entity\Dico
     */
    public function getPortes()
    {
        return $this->portes;
    }

    /**
     * Set places
     *
     * @param \CorentApi\ApiBundle\Entity\Dico $places
     *
     * @return Voiture
     */
    public function setPlaces(\CorentApi\ApiBundle\Entity\Dico $places = null)
    {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return \CorentApi\ApiBundle\Entity\Dico
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set carburant
     *
     * @param \CorentApi\ApiBundle\Entity\Dico $carburant
     *
     * @return Voiture
     */
    public function setCarburant(\CorentApi\ApiBundle\Entity\Dico $carburant = null)
    {
        $this->carburant = $carburant;

        return $this;
    }

    /**
     * Get carburant
     *
     * @return \CorentApi\ApiBundle\Entity\Dico
     */
    public function getCarburant()
    {
        return $this->carburant;
    }

    /**
     * Set boite
     *
     * @param \CorentApi\ApiBundle\Entity\Dico $boite
     *
     * @return Voiture
     */
    public function setBoite(\CorentApi\ApiBundle\Entity\Dico $boite = null)
    {
        $this->boite = $boite;

        return $this;
    }

    /**
     * Get boite
     *
     * @return \CorentApi\ApiBundle\Entity\Dico
     */
    public function getBoite()
    {
        return $this->boite;
    }

    /**
     * Set kmParcourues
     *
     * @param \CorentApi\ApiBundle\Entity\Dico $kmParcourues
     *
     * @return Voiture
     */
    public function setKmParcourues(\CorentApi\ApiBundle\Entity\Dico $kmParcourues = null)
    {
        $this->kmParcourues = $kmParcourues;

        return $this;
    }

    /**
     * Get kmParcourues
     *
     * @return \CorentApi\ApiBundle\Entity\Dico
     */
    public function getKmParcourues()
    {
        return $this->kmParcourues;
    }

    /**
     * Add option
     *
     * @param \CorentApi\ApiBundle\Entity\Dico $option
     *
     * @return Voiture
     */
    public function addOption(\CorentApi\ApiBundle\Entity\Dico $option)
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     * Remove option
     *
     * @param \CorentApi\ApiBundle\Entity\Dico $option
     */
    public function removeOption(\CorentApi\ApiBundle\Entity\Dico $option)
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
}
