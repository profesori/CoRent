<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModeleVoiture
 *
 * @ORM\Table(name="modele_voiture")
 * @ORM\Entity(repositoryClass="CorentApi\ApiBundle\Repository\ModeleVoitureRepository")
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
    * @ORM\ManyToOne(targetEntity="Voiture", inversedBy="modeles")
    */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="annee_production", type="string", length=4)
     */
    private $anneeProduction;


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
     * @param \CorentApi\ApiBundle\Entity\Voiture $marque
     *
     * @return ModeleVoiture
     */
    public function setMarque(\CorentApi\ApiBundle\Entity\Voiture $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \CorentApi\ApiBundle\Entity\Voiture
     */
    public function getMarque()
    {
        return $this->marque;
    }
}
