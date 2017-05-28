<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Photo;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FilesToPhotosTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
    }

    public function reverseTransform($files)
    {
        $photos = [];
        foreach ($files as $file) {
            $photo = new Photo();
            $photo->setImageFile($file);
            $photos[] = $photo;
        }
        return $photos;
    }
}
