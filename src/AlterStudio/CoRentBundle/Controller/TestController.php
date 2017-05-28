<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Form\AnnonceTestType;
use AppBundle\Form\AdresseType;
use AppBundle\Form\PhotoType;
use AppBundle\Entity\Annonce;
use AppBundle\Entity\Voiture;
use AppBundle\Entity\Adresse;
use AppBundle\Entity\Ville;
use AppBundle\Entity\Pays;
use AppBundle\Entity\Photo;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    /**
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function addAction(Request $request)
    {
        $photo = new Annonce();
      //  $annonce->setAdresseVoiture($adresse);
        /*
        $voiture = new Voiture();

        $ville = new Ville();
        $pays = new Pays();
        $photos = new \Doctrine\Common\Collections\ArrayCollection();
        $ville->setPays($pays);
        $adresse->setVille($ville);


        $annonce->setPhotos($photos);

        $form   = $this->createForm(AnnonceTestType::class, $photo);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $photos = $form->getData()->getPhotos();
            var_dump($photos);

            $em->persist($photo);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            return $this->redirectToRoute('profile');
        }*/
        return $this->render('corent/simpleForm.html.twig');
    }

    public function detailAction()
    {
        return $this->render('corent/annonce_detail.html.twig');
    }
}
