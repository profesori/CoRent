<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Locataire
 *
 * @ORM\Table(name="locataire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocataireRepository")
 */
class Locataire extends User
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
     * @ORM\OneToMany(targetEntity="DemandesAnnonce", mappedBy="locataire")
     */
    private $demandes;


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
     * Add demande
     *
     * @param \CorentApi\ApiBundle\Entity\DemandesAnnonce $demande
     *
     * @return Locataire
     */
    public function addDemande(\CorentApi\ApiBundle\Entity\DemandesAnnonce $demande)
    {
        $this->demandes[] = $demande;

        return $this;
    }

    /**
     * Remove demande
     *
     * @param \CorentApi\ApiBundle\Entity\DemandesAnnonce $demande
     */
    public function removeDemande(\CorentApi\ApiBundle\Entity\DemandesAnnonce $demande)
    {
        $this->demandes->removeElement($demande);
    }

    /**
     * Get demandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandes()
    {
        return $this->demandes;
    }
}
