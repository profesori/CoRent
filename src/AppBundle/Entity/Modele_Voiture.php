<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modele_Voiture
 *
 * @ORM\Table(name="modele__voiture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Modele_VoitureRepository")
 */
class Modele_Voiture
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
     * @ORM\Column(name="modele", type="string", length=255)
     */
    private $modele;

    /**
    * Many Modele have One Marque.
    * @ORM\ManyToOne(targetEntity="Marque_Voiture", inversedBy="$modele")
    */
    private $marque;


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
     * Set modele
     *
     * @param string $modele
     *
     * @return Modele_Voiture
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set marque
     *
     * @param \AppBundle\Entity\Marque_Voiture $marque
     *
     * @return Modele_Voiture
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
}
