<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChatDemande
 *
 * @ORM\Table(name="chat_demande")
 * @ORM\Entity(repositoryClass="CorentApi\ApiBundle\Repository\ChatDemandeRepository")
 */
class ChatDemande
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
     * @ORM\Column(name="dateMessage", type="datetime")
     */
    private $dateMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;
    /**
    * @ORM\ManyToOne(targetEntity="DemandesAnnonce", inversedBy="messages")
    */
    private $demande;
    /**
     * @var bool
     *
     * @ORM\Column(name="isLocataire", type="boolean")
     */
    private $isLocataire;


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
     * Set dateMessage
     *
     * @param \DateTime $dateMessage
     *
     * @return ChatDemande
     */
    public function setDateMessage($dateMessage)
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    /**
     * Get dateMessage
     *
     * @return \DateTime
     */
    public function getDateMessage()
    {
        return $this->dateMessage;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return ChatDemande
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set isLocataire
     *
     * @param boolean $isLocataire
     *
     * @return ChatDemande
     */
    public function setIsLocataire($isLocataire)
    {
        $this->isLocataire = $isLocataire;

        return $this;
    }

    /**
     * Get isLocataire
     *
     * @return boolean
     */
    public function getIsLocataire()
    {
        return $this->isLocataire;
    }

    /**
     * Set demande
     *
     * @param \CorentApi\ApiBundle\Entity\DemandesAnnonce $demande
     *
     * @return ChatDemande
     */
    public function setDemande(\CorentApi\ApiBundle\Entity\DemandesAnnonce $demande = null)
    {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Get demande
     *
     * @return \CorentApi\ApiBundle\Entity\DemandesAnnonce
     */
    public function getDemande()
    {
        return $this->demande;
    }
}
