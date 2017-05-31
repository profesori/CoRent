<?php
// src/Acme/ApiBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table("users")
 * @ORM\Entity
 *
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\Column(type="string", length=255)
    *
    * @Assert\NotBlank(message="Emri eshte i detyrueshem", groups={"Registration", "Profile"})
    * @Assert\Length(
    *     min=3,
    *     max=255,
    *     minMessage="The name is too short.",
    *     maxMessage="The name is too long.",
    *     groups={"Registration", "Profile"}
    * )
    */
    private $emri;
    /**
    * @ORM\Column(type="string", length=255)
    *
    * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
    * @Assert\Length(
    *     min=3,
    *     max=255,
    *     minMessage="The name is too short.",
    *     maxMessage="The name is too long.",
    *     groups={"Registration", "Profile"}
    * )
    */
    private $mbiemri;
    /**
    * @ORM\Column(type="string", length=10)
    *
    * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
    * @Assert\Length(
    *     min=3,
    *     max=10,
    *     minMessage="The name is too short.",
    *     maxMessage="The name is too long.",
    *     groups={"Registration", "Profile"}
    * )
    */
    private $telefoni;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set emri
     *
     * @param string $emri
     *
     * @return User
     */
    public function setEmri($emri)
    {
        $this->emri = $emri;

        return $this;
    }

    /**
     * Get emri
     *
     * @return string
     */
    public function getEmri()
    {
        return $this->emri;
    }

    /**
     * Set mbiemri
     *
     * @param string $mbiemri
     *
     * @return User
     */
    public function setMbiemri($mbiemri)
    {
        $this->mbiemri = $mbiemri;

        return $this;
    }

    /**
     * Get mbiemri
     *
     * @return string
     */
    public function getMbiemri()
    {
        return $this->mbiemri;
    }

    /**
     * Set telefoni
     *
     * @param string $telefoni
     *
     * @return User
     */
    public function setTelefoni($telefoni)
    {
        $this->telefoni = $telefoni;

        return $this;
    }

    /**
     * Get telefoni
     *
     * @return string
     */
    public function getTelefoni()
    {
        return $this->telefoni;
    }
}
