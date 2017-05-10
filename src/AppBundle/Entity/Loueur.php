<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loueur
 *
 * @ORM\Table(name="loueur")
 * @ORM\Entity(repositoryClass="CorentApi\ApiBundle\Repository\LoueurRepository")
 */
class Loueur extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\OneToMany(targetEntity="Annonce", mappedBy="loueur")
     */
    private $annonces;


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
     * Add annonce
     *
     * @param \CorentApi\ApiBundle\Entity\Annonce $annonce
     *
     * @return Loueur
     */
    public function addAnnonce(\CorentApi\ApiBundle\Entity\Annonce $annonce)
    {
        $this->annonces[] = $annonce;

        return $this;
    }

    /**
     * Remove annonce
     *
     * @param \CorentApi\ApiBundle\Entity\Annonce $annonce
     */
    public function removeAnnonce(\CorentApi\ApiBundle\Entity\Annonce $annonce)
    {
        $this->annonces->removeElement($annonce);
    }

    /**
     * Get annonces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnonces()
    {
        return $this->annonces;
    }
}
