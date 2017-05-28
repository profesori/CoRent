<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnnonceRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Annonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAnnonce", type="datetimetz",nullable=true)
     */
    private $dateAnnonce;
    /**
     * @var bool
     *
     * @ORM\Column(name="landing", type="boolean",nullable=true)
     */
    private $landing;

    /**
     * @var int
     *
     * @ORM\Column(name="prixJour", type="integer",nullable=true)
     */
    private $prixJour;

    /**
     * @var string
     *
     * @ORM\Column(name="prixKM", type="decimal", precision=5, scale=2,nullable=true)
     */
    private $prixKM;

    /**
     * @var bool
     *
     * @ORM\Column(name="enligne", type="boolean",nullable=true)
     */
    private $enligne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateMiseEnLigne", type="datetime",nullable=true)
     */
    private $dateMiseEnLigne;
    /**
    * @ORM\OneToOne(targetEntity="Voiture",cascade={"persist"})
    */
   private $voiture;
   /**
   * @ORM\ManyToOne(targetEntity="Adresse",cascade={"persist"})
   */
   private $adresseVoiture;
   /**
    * @var int
    *
    * @ORM\Column(name="dureeLocation", type="integer",nullable=true)
    */
   private $dureeLocation;
   /**
    * @var int
    *
    * @ORM\Column(name="limiteKM", type="integer",nullable=true)
    */
   private $limiteKM;
   /**
    * @var string
    *
    * @ORM\Column(name="exigences", type="string", length=255,nullable=true)
    */
   private $exigences;
   /**
    * @ORM\OneToMany(targetEntity="Calendrier", mappedBy="annonce")
    */
   private $calendrier;
   /**
   * @ORM\ManyToOne(targetEntity="User")
   */
   private $loueur;
   /**
    * @ORM\OneToMany(targetEntity="CommentairesAnnonces", mappedBy="annonce")
    */
   private $commentaires;
   /**
   * @ORM\OneToMany(targetEntity="DemandesAnnonce", mappedBy="annonce")
   */
   private $demandes;
   /**
   * @ORM\OneToMany(targetEntity="Photo", mappedBy="annonce",cascade={"persist"})
   */
    protected $photos;


    /**
     * @ORM\PrePersist
     */
    public function updateDate()
    {
        $this->setDateAnnonce(new \Datetime());
        $this->setDateMiseEnLigne(new \Datetime());
        $this->setEnLigne(true);
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
     * @param \AppBundle\Entity\Voiture $voiture
     *
     * @return Annonce
     */
    public function setVoiture(\AppBundle\Entity\Voiture $voiture = null)
    {
        $this->voiture = $voiture;

        return $this;
    }

    /**
     * Get voiture
     *
     * @return \AppBundle\Entity\Voiture
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * Set adresseVoiture
     *
     * @param \AppBundle\Entity\Adresse $adresseVoiture
     *
     * @return Annonce
     */
    public function setAdresseVoiture(\AppBundle\Entity\Adresse $adresseVoiture = null)
    {
        $this->adresseVoiture = $adresseVoiture;

        return $this;
    }

    /**
     * Get adresseVoiture
     *
     * @return \AppBundle\Entity\Adresse
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
        $this->photos =  new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set loueur
     *
     * @param \AppBundle\Entity\User $loueur
     *
     * @return Annonce
     */
    public function setLoueur(\AppBundle\Entity\User $loueur = null)
    {
        $this->loueur = $loueur;

        return $this;
    }

    /**
     * Get loueur
     *
     * @return \AppBundle\Entity\User
     */
    public function getLoueur()
    {
        return $this->loueur;
    }

    /**
     * Add commentaire
     *
     * @param \AppBundle\Entity\CommentairesAnnonces $commentaire
     *
     * @return Annonce
     */
    public function addCommentaire(\AppBundle\Entity\CommentairesAnnonces $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \AppBundle\Entity\CommentairesAnnonces $commentaire
     */
    public function removeCommentaire(\AppBundle\Entity\CommentairesAnnonces $commentaire)
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
     * @param \AppBundle\Entity\DemandesAnnonce $demande
     *
     * @return Annonce
     */
    public function addDemande(\AppBundle\Entity\DemandesAnnonce $demande)
    {
        $this->demandes[] = $demande;

        return $this;
    }

    /**
     * Remove demande
     *
     * @param \AppBundle\Entity\DemandesAnnonce $demande
     */
    public function removeDemande(\AppBundle\Entity\DemandesAnnonce $demande)
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


    /**
     * Set landing
     *
     * @param boolean $landing
     *
     * @return Annonce
     */
    public function setLanding($landing)
    {
        $this->landing = $landing;

        return $this;
    }

    /**
     * Get landing
     *
     * @return boolean
     */
    public function getLanding()
    {
        return $this->landing;
    }

    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Photo $photo
     *
     * @return Annonce
     */
    public function addPhoto(\AppBundle\Entity\Photo $photo)
    {
        $this->photos[] = $photo;
        $photo->setAnnonce($this);

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \AppBundle\Entity\Photo $photo
     */
    public function removePhoto(\AppBundle\Entity\Photo $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
