<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\MarqueVoiture;
use AppBundle\Entity\ModeleVoiture;

class LoadMarque implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des noms de compétences à ajouter
    $marques = array('Mercedes'=>array('C220','E280'), 'BMW'=>array('Series 5','Series 6'),
              'Volkswagen'=>array('Golf','Polo'), 'Fiat'=>array('Punto','500'), 'Renault'=>array('Megane','Espace'),
              'Peugeot'=>array('208','508'), 'Ford'=>array('Fiesta','Ka'));

        foreach ($marques as $marq=> $modeles) {
            // On crée la compétence

            $marque = new MarqueVoiture();
            $marque->setMarque($marq);
            $manager->persist($marque);
            foreach ($modeles as $model) {
                $modele = new ModeleVoiture();
                $modele->setModele($model);
                $modele->setMarque($marque);
                $manager->persist($modele);
            }
        }
    // On déclenche l'enregistrement de toutes les compétences
    $manager->flush();
    }
}
