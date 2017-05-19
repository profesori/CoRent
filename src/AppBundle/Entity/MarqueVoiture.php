<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MarqueVoiture
 *
 * @ORM\Table(name="marque_voiture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MarqueVoitureRepository")
 */
class MarqueVoiture
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->marque;
    }
    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return MarqueVoiture
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
     * @param \AppBundle\Entity\ModeleVoiture $modele
     *
     * @return MarqueVoiture
     */
    public function addModele(\AppBundle\Entity\ModeleVoiture $modele)
    {
        $this->modeles[] = $modele;

        return $this;
    }

    /**
     * Remove modele
     *
     * @param \AppBundle\Entity\ModeleVoiture $modele
     */
    public function removeModele(\AppBundle\Entity\ModeleVoiture $modele)
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
}
