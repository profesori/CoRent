<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DicoType
 *
 * @ORM\Table(name="dico_type")
 * @ORM\Entity(repositoryClass="CorentApi\ApiBundle\Repository\DicoTypeRepository")
 */
class DicoType
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
     * @ORM\Column(name="dicotype_libelle", type="string", length=255)
     */
    private $dicotypeLibelle;

    /**
     * @ORM\OneToMany(targetEntity="Dico", mappedBy="dicotype")
     */
    private $dicos;


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
     * Set dicotypeLibelle
     *
     * @param string $dicotypeLibelle
     *
     * @return DicoType
     */
    public function setDicotypeLibelle($dicotypeLibelle)
    {
        $this->dicotypeLibelle = $dicotypeLibelle;

        return $this;
    }

    /**
     * Get dicotypeLibelle
     *
     * @return string
     */
    public function getDicotypeLibelle()
    {
        return $this->dicotypeLibelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dicos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dico
     *
     * @param \CorentApi\ApiBundle\Entity\Dico $dico
     *
     * @return DicoType
     */
    public function addDico(\CorentApi\ApiBundle\Entity\Dico $dico)
    {
        $this->dicos[] = $dico;

        return $this;
    }

    /**
     * Remove dico
     *
     * @param \CorentApi\ApiBundle\Entity\Dico $dico
     */
    public function removeDico(\CorentApi\ApiBundle\Entity\Dico $dico)
    {
        $this->dicos->removeElement($dico);
    }

    /**
     * Get dicos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDicos()
    {
        return $this->dicos;
    }
}
