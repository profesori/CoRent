<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandesAnnonce
 *
 * @ORM\Table(name="demandes_annonce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DemandesAnnonceRepository")
 */
class DemandesAnnonce
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
     * @ORM\Column(name="dateDemande", type="datetime")
     */
    private $dateDemande;
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
     * @ORM\Column(name="KM", type="integer")
     */
    private $kM;
    /**
    * @ORM\ManyToOne(targetEntity="Annonce", inversedBy="demandes")
    */
    private $annonce;
    /**
    * @ORM\ManyToOne(targetEntity="User")
    */
    private $locataire;
    /**
    * @ORM\OneToMany(targetEntity="ChatDemande", mappedBy="demande")
    */
    private $chatMessages;
    /**
     * @var bool
     *
     * @ORM\Column(name="isAccepte", type="boolean")
     */
    private $isAccepte;
    /**
     * @var bool
     *
     * @ORM\Column(name="invalide", type="boolean")
     */
    private $invalide;


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
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     *
     * @return DemandesAnnonce
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set isAccepte
     *
     * @param boolean $isAccepte
     *
     * @return DemandesAnnonce
     */
    public function setIsAccepte($isAccepte)
    {
        $this->isAccepte = $isAccepte;

        return $this;
    }

    /**
     * Get isAccepte
     *
     * @return boolean
     */
    public function getIsAccepte()
    {
        return $this->isAccepte;
    }

    /**
     * Set annonce
     *
     * @param \AppBundle\Entity\Annonce $annonce
     *
     * @return DemandesAnnonce
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

    /**
     * Set locataire
     *
     * @param \AppBundle\Entity\Locataire $locataire
     *
     * @return DemandesAnnonce
     */
    public function setLocataire(\AppBundle\Entity\Locataire $locataire = null)
    {
        $this->locataire = $locataire;

        return $this;
    }

    /**
     * Get locataire
     *
     * @return \AppBundle\Entity\Locataire
     */
    public function getLocataire()
    {
        return $this->locataire;
    }

    /**
     * Add message
     *
     * @param \AppBundle\Entity\ChatDemande $message
     *
     * @return DemandesAnnonce
     */
    public function addMessage(\AppBundle\Entity\ChatDemande $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \AppBundle\Entity\ChatDemande $message
     */
    public function removeMessage(\AppBundle\Entity\ChatDemande $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return DemandesAnnonce
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
     * @return DemandesAnnonce
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
     * @return DemandesAnnonce
     */
    public function setKM($kM)
    {
        $this->kM = $kM;

        return $this;
    }

    /**
     * Get kM
     *
     * @return integer
     */
    public function getKM()
    {
        return $this->kM;
    }

    /**
     * Set invalide
     *
     * @param boolean $invalide
     *
     * @return DemandesAnnonce
     */
    public function setInvalide($invalide)
    {
        $this->invalide = $invalide;

        return $this;
    }

    /**
     * Get invalide
     *
     * @return boolean
     */
    public function getInvalide()
    {
        return $this->invalide;
    }

    /**
     * Add chatMessage
     *
     * @param \AppBundle\Entity\ChatDemande $chatMessage
     *
     * @return DemandesAnnonce
     */
    public function addChatMessage(\AppBundle\Entity\ChatDemande $chatMessage)
    {
        $this->chatMessages[] = $chatMessage;

        return $this;
    }

    /**
     * Remove chatMessage
     *
     * @param \AppBundle\Entity\ChatDemande $chatMessage
     */
    public function removeChatMessage(\AppBundle\Entity\ChatDemande $chatMessage)
    {
        $this->chatMessages->removeElement($chatMessage);
    }

    /**
     * Get chatMessages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChatMessages()
    {
        return $this->chatMessages;
    }
}
