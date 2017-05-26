<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModeleVoiture
 *
 * @ORM\Table(name="modele_voiture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModeleVoitureRepository")
 */
class ModeleVoiture
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
    * @ORM\ManyToOne(targetEntity="PriceCategorie")
    */
    private $categorie;
    /**
    * @ORM\ManyToOne(targetEntity="MarqueVoiture", inversedBy="modeles")
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
     * @return ModeleVoiture
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
     * Set anneeProduction
     *
     * @param string $anneeProduction
     *
     * @return ModeleVoiture
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

    /**
     * Set marque
     *
     * @param \AppBundle\Entity\MarqueVoiture $marque
     *
     * @return ModeleVoiture
     */
    public function setMarque(\AppBundle\Entity\MarqueVoiture $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \AppBundle\Entity\MarqueVoiture
     */
    public function getMarque()
    {
        return $this->marque;
    }
    public function __toString()
    {
        return $this->modele;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\PriceCategorie $categorie
     *
     * @return ModeleVoiture
     */
    public function setCategorie(\AppBundle\Entity\PriceCategorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\PriceCategorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
