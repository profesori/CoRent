<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 */
class Photo
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="annonce_photo", fileNameProperty="imageName", size="size")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;
    /**
     * @var float
     *
     * @ORM\Column(name="size", type="float")
     */
    private $size;

    /**
     * @var float
     *
     * @ORM\Column(name="sizeThumb", type="float")
     */
    private $sizeThumb;
    /**
    * @ORM\ManyToOne(targetEntity="Annonce", inversedBy="photos")
    */
    private $annonce;


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
     * Set photoUrl
     *
     * @param string $photoUrl
     *
     * @return Photo
     */
    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;

        return $this;
    }

    /**
     * Get photoUrl
     *
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    /**
     * Set thumbUrl
     *
     * @param string $thumbUrl
     *
     * @return Photo
     */
    public function setThumbUrl($thumbUrl)
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    /**
     * Get thumbUrl
     *
     * @return string
     */
    public function getThumbUrl()
    {
        return $this->thumbUrl;
    }

    /**
     * Set size
     *
     * @param float $size
     *
     * @return Photo
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return float
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set sizeThumb
     *
     * @param float $sizeThumb
     *
     * @return Photo
     */
    public function setSizeThumb($sizeThumb)
    {
        $this->sizeThumb = $sizeThumb;

        return $this;
    }

    /**
     * Get sizeThumb
     *
     * @return float
     */
    public function getSizeThumb()
    {
        return $this->sizeThumb;
    }

    /**
     * Set annonce
     *
     * @param \AppBundle\Entity\Annonce $annonce
     *
     * @return Photo
     */
    public function setAnnonce(\AppBundle\Entity\Annonce $annonce = null)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \AppBundle\Entity\Annonce
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Photo
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }
}
