<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dico
 *
 * @ORM\Table(name="dico")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DicoRepository")
 */
class Dico
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
     * @ORM\Column(name="dico_libelle", type="string", length=255)
     */
    private $dicoLibelle;
    /**
    * @ORM\ManyToOne(targetEntity="DicoType", inversedBy="dicos")
    */
   private $dicotype;


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
        return (string) $this->getDicoLibelle();
    }
    /**
     * Set dicoLibelle
     *
     * @param string $dicoLibelle
     *
     * @return Dico
     */
    public function setDicoLibelle($dicoLibelle)
    {
        $this->dicoLibelle = $dicoLibelle;

        return $this;
    }

    /**
     * Get dicoLibelle
     *
     * @return string
     */
    public function getDicoLibelle()
    {
        return $this->dicoLibelle;
    }

    /**
     * Set dicotype
     *
     * @param \CorentApi\ApiBundle\Entity\DicoType $dicotype
     *
     * @return Dico
     */
    public function setDicotype(\AppBundle\Entity\DicoType $dicotype = null)
    {
        $this->dicotype = $dicotype;

        return $this;
    }

    /**
     * Get dicotype
     *
     * @return \CorentApi\ApiBundle\Entity\DicoType
     */
    public function getDicotype()
    {
        return $this->dicotype;
    }
}
