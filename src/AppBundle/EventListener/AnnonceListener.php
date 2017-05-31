<?php
// src/AppBundle/EventListener/SearchIndexer.php
namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\DemandeAnnonce;
use AppBundle\Entity\Calendrier;

class AnnonceListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // only act on some "Product" entity
        if (!$entity instanceof Annonce) {
            return;
        }

        $entityManager = $args->getEntityManager();
        //Boucle 1 an pour mettre à jour le calendrier
    }
}
