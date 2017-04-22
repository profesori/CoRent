<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marque_Voiture
 *
 * @ORM\Table(name="marque__voiture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Marque_VoitureRepository")
 */
class Marque_Voiture
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
     * @ORM\Column(name="marque", type="string", length=255, unique=true)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_marque", type="string", length=255)
     */
    private $logoMarque;
    /**
     * One Marque has Many Modele.
     * @ORM\OneToMany(targetEntity="Modele_Voiture", mappedBy="$marque")
     */
     private $modele;


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
     * @return Marque_Voiture
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
     * Set logoMarque
     *
     * @param string $logoMarque
     *
     * @return Marque_Voiture
     */
    public function setLogoMarque($logoMarque)
    {
        $this->logoMarque = $logoMarque;

        return $this;
    }

    /**
     * Get logoMarque
     *
     * @return string
     */
    public function getLogoMarque()
    {
        return $this->logoMarque;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modele = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add modele
     *
     * @param \AppBundle\Entity\Modele_Voiture $modele
     *
     * @return Marque_Voiture
     */
    public function addModele(\AppBundle\Entity\Modele_Voiture $modele)
    {
        $this->modele[] = $modele;

        return $this;
    }

    /**
     * Remove modele
     *
     * @param \AppBundle\Entity\Modele_Voiture $modele
     */
    public function removeModele(\AppBundle\Entity\Modele_Voiture $modele)
    {
        $this->modele->removeElement($modele);
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
}
