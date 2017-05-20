<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\DicoType;
use AppBundle\Entity\Dico;

class LoadOptions implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des noms de compétences à ajouter
        $type = "OPTIONES";
        $options = array("Klime","Navigator","Sedilje per bebe","Manjtofon");

        $dicotype = new DicoType();
        $dicotype->setDicotypeLibelle($type);
        $manager->persist($dicotype);
        foreach ($options as $opt) {
            $dico = new Dico();
            $dico->setDicoLibelle($opt);
            $dico->setDicotype($dicotype);
            $manager->persist($dico);
        }
    // On déclenche l'enregistrement de toutes les compétences
        $manager->flush();
    }
}
