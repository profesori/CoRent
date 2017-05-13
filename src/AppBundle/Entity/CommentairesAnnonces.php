<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentairesAnnonces
 *
 * @ORM\Table(name="commentaires_annonces")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentairesAnnoncesRepository")
 */
class CommentairesAnnonces
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
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCommentaire", type="datetime")
     */
    private $dateCommentaire;
    /**
    * @ORM\ManyToOne(targetEntity="Annonce", inversedBy="commentaires")
    */
    private $annonce;


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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return CommentairesAnnonces
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set dateCommentaire
     *
     * @param \DateTime $dateCommentaire
     *
     * @return CommentairesAnnonces
     */
    public function setDateCommentaire($dateCommentaire)
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    /**
     * Get dateCommentaire
     *
     * @return \DateTime
     */
    public function getDateCommentaire()
    {
        return $this->dateCommentaire;
    }

    /**
     * Set annonces
     *
     * @param \CorentApi\ApiBundle\Entity\DemandesAnnonce $annonces
     *
     * @return CommentairesAnnonces
     */
    public function setAnnonces(\CorentApi\ApiBundle\Entity\DemandesAnnonce $annonces = null)
    {
        $this->annonces = $annonces;

        return $this;
    }

    /**
     * Get annonces
     *
     * @return \CorentApi\ApiBundle\Entity\DemandesAnnonce
     */
    public function getAnnonces()
    {
        return $this->annonces;
    }

    /**
     * Set annonce
     *
     * @param \AppBundle\Entity\Annonce $annonce
     *
     * @return CommentairesAnnonces
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
}
