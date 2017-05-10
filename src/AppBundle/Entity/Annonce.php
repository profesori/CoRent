<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="CorentApi\ApiBundle\Repository\AnnonceRepository")
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateAnnonce", type="datetimetz")
     */
    private $dateAnnonce;

    /**
     * @var int
     *
     * @ORM\Column(name="prixJour", type="integer")
     */
    private $prixJour;

    /**
     * @var string
     *
     * @ORM\Column(name="prixKM", type="decimal", precision=5, scale=2)
     */
    private $prixKM;

    /**
     * @var bool
     *
     * @ORM\Column(name="enligne", type="boolean")
     */
    private $enligne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateMiseEnLigne", type="datetime")
     */
    private $dateMiseEnLigne;
    /**
    * @ORM\OneToOne(targetEntity="Voiture")
    */
   private $voiture;
   /**
   * @ORM\ManyToOne(targetEntity="Adresse")
   */
   private $adresseVoiture;
   /**
    * @var int
    *
    * @ORM\Column(name="dureeLocation", type="integer")
    */
   private $dureeLocation;
   /**
    * @var int
    *
    * @ORM\Column(name="limiteKM", type="integer")
    */
   private $limiteKM;
   /**
    * @var string
    *
    * @ORM\Column(name="exigences", type="string", length=255)
    */
   private $exigences;
   /**
    * @ORM\OneToMany(targetEntity="Calendrier", mappedBy="annonce")
    */
   private $calendrier;
   /**
   * @ORM\ManyToOne(targetEntity="Loueur", inversedBy="annonces")
   */
   private $loueur;
   /**
    * @ORM\OneToMany(targetEntity="CommentairesAnnonces", mappedBy="annonces")
    */
   private $commentaires;
   /**
   * @ORM\OneToMany(targetEntity="DemandesAnnonce", mappedBy="annonce")
   */
   private $demandes;



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
     * Set dateAnnonce
     *
     * @param \DateTime $dateAnnonce
     *
     * @return Annonce
     */
    public function setDateAnnonce($dateAnnonce)
    {
        $this->dateAnnonce = $dateAnnonce;

        return $this;
    }

    /**
     * Get dateAnnonce
     *
     * @return \DateTime
     */
    public function getDateAnnonce()
    {
        return $this->dateAnnonce;
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
     * Set prixKM
     *
     * @param string $prixKM
     *
     * @return Annonce
     */
    public function setPrixKM($prixKM)
    {
        $this->prixKM = $prixKM;

        return $this;
    }

    /**
     * Get prixKM
     *
     * @return string
     */
    public function getPrixKM()
    {
        return $this->prixKM;
    }

    /**
     * Set enligne
     *
     * @param boolean $enligne
     *
     * @return Annonce
     */
    public function setEnligne($enligne)
    {
        $this->enligne = $enligne;

        return $this;
    }

    /**
     * Get enligne
     *
     * @return bool
     */
    public function getEnligne()
    {
        return $this->enligne;
    }

    /**
     * Set dateMiseEnLigne
     *
     * @param \DateTime $dateMiseEnLigne
     *
     * @return Annonce
     */
    public function setDateMiseEnLigne($dateMiseEnLigne)
    {
        $this->dateMiseEnLigne = $dateMiseEnLigne;

        return $this;
    }

    /**
     * Get dateMiseEnLigne
     *
     * @return \DateTime
     */
    public function getDateMiseEnLigne()
    {
        return $this->dateMiseEnLigne;
    }

    /**
     * Set dureeLocation
     *
     * @param integer $dureeLocation
     *
     * @return Annonce
     */
    public function setDureeLocation($dureeLocation)
    {
        $this->dureeLocation = $dureeLocation;

        return $this;
    }

    /**
     * Get dureeLocation
     *
     * @return integer
     */
    public function getDureeLocation()
    {
        return $this->dureeLocation;
    }

    /**
     * Set limiteKM
     *
     * @param integer $limiteKM
     *
     * @return Annonce
     */
    public function setLimiteKM($limiteKM)
    {
        $this->limiteKM = $limiteKM;

        return $this;
    }

    /**
     * Get limiteKM
     *
     * @return integer
     */
    public function getLimiteKM()
    {
        return $this->limiteKM;
    }

    /**
     * Set exigences
     *
     * @param string $exigences
     *
     * @return Annonce
     */
    public function setExigences($exigences)
    {
        $this->exigences = $exigences;

        return $this;
    }

    /**
     * Get exigences
     *
     * @return string
     */
    public function getExigences()
    {
        return $this->exigences;
    }

    /**
     * Set voiture
     *
     * @param \CorentApi\ApiBundle\Entity\Voiture $voiture
     *
     * @return Annonce
     */
    public function setVoiture(\CorentApi\ApiBundle\Entity\Voiture $voiture = null)
    {
        $this->voiture = $voiture;

        return $this;
    }

    /**
     * Get voiture
     *
     * @return \CorentApi\ApiBundle\Entity\Voiture
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * Set adresseVoiture
     *
     * @param \CorentApi\ApiBundle\Entity\Adresse $adresseVoiture
     *
     * @return Annonce
     */
    public function setAdresseVoiture(\CorentApi\ApiBundle\Entity\Adresse $adresseVoiture = null)
    {
        $this->adresseVoiture = $adresseVoiture;

        return $this;
    }

    /**
     * Get adresseVoiture
     *
     * @return \CorentApi\ApiBundle\Entity\Adresse
     */
    public function getAdresseVoiture()
    {
        return $this->adresseVoiture;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->calendrier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add calendrier
     *
     * @param \CorentApi\ApiBundle\Entity\Calendrier $calendrier
     *
     * @return Annonce
     */
    public function addCalendrier(\CorentApi\ApiBundle\Entity\Calendrier $calendrier)
    {
        $this->calendrier[] = $calendrier;

        return $this;
    }

    /**
     * Remove calendrier
     *
     * @param \CorentApi\ApiBundle\Entity\Calendrier $calendrier
     */
    public function removeCalendrier(\CorentApi\ApiBundle\Entity\Calendrier $calendrier)
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

    /**
     * Set loueur
     *
     * @param \CorentApi\ApiBundle\Entity\Loueur $loueur
     *
     * @return Annonce
     */
    public function setLoueur(\CorentApi\ApiBundle\Entity\Loueur $loueur = null)
    {
        $this->loueur = $loueur;

        return $this;
    }

    /**
     * Get loueur
     *
     * @return \CorentApi\ApiBundle\Entity\Loueur
     */
    public function getLoueur()
    {
        return $this->loueur;
    }

    /**
     * Add commentaire
     *
     * @param \CorentApi\ApiBundle\Entity\CommentairesAnnonces $commentaire
     *
     * @return Annonce
     */
    public function addCommentaire(\CorentApi\ApiBundle\Entity\CommentairesAnnonces $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \CorentApi\ApiBundle\Entity\CommentairesAnnonces $commentaire
     */
    public function removeCommentaire(\CorentApi\ApiBundle\Entity\CommentairesAnnonces $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Add demande
     *
     * @param \CorentApi\ApiBundle\Entity\DemandesAnnonce $demande
     *
     * @return Annonce
     */
    public function addDemande(\CorentApi\ApiBundle\Entity\DemandesAnnonce $demande)
    {
        $this->demandes[] = $demande;

        return $this;
    }

    /**
     * Remove demande
     *
     * @param \CorentApi\ApiBundle\Entity\DemandesAnnonce $demande
     */
    public function removeDemande(\CorentApi\ApiBundle\Entity\DemandesAnnonce $demande)
    {
        $this->demandes->removeElement($demande);
    }

    /**
     * Get demandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandes()
    {
        return $this->demandes;
    }
}
