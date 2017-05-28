<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Form\AnnonceType;
use AppBundle\Form\VoitureType;
use AppBundle\Form\PhotoType;
use AppBundle\Entity\Annonce;
use AppBundle\Entity\Voiture;
use AppBundle\Entity\Adresse;
use AppBundle\Entity\Ville;
use AppBundle\Entity\Pays;
use AppBundle\Entity\Photo;
use Symfony\Component\HttpFoundation\Request;

class AnnonceController extends Controller
{
    /**
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function addAction(Request $request)
    {
        $annonce = new Annonce();
        $adresse = new Adresse();
        //$photo = new Photo();
        $annonce->setAdresseVoiture($adresse);
        //$annonce->addPhoto($photo);
        /*
        $voiture = new Voiture();

        $ville = new Ville();
        $pays = new Pays();
        $photos = new \Doctrine\Common\Collections\ArrayCollection();
        $ville->setPays($pays);
        $adresse->setVille($ville);


        $annonce->setPhotos($photos);*/

        $form   = $this->createForm(AnnonceType::class, $annonce);


        if ($request->isXmlHttpRequest()) {
            $formVoiture = $form->handleRequest($request);
        } else {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                //get user connected user
                $user = $this->getUser();

                if (!$user) {
                    throw new AccessDeniedException();
                }
                $annonce->setLoueur($user);
                $em = $this->getDoctrine()->getManager();
                $em->persist($annonce);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                return $this->redirectToRoute('profile');
            }
        }
        return $this->render('corent/create_vehicle.html.twig', array(
          'form' => $form->createView()
        ));
    }
    /**
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('AppBundle:Annonce')->find($id);
        $form   = $this->createForm(AnnonceType::class, $annonce);


        if (null === $annonce) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        $photos = $annonce->getPhotos();
        $arrayPhoto = "";
        foreach ($photos as $photo) {
            $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
            $path = $helper->asset($photo, 'imageFile');
            $arrayPhoto[] = $path;
        };
        if ($request->isXmlHttpRequest()) {
            $formVoiture = $form->handleRequest($request);
        } else {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                return $this->redirectToRoute('profile');
            }
        }
        return $this->render('corent/edit_vehicle.html.twig', array('form'=>$form->createView(),"photos"=>$arrayPhoto));
    }

    /**
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function deletePhotoAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            //get Data
        }
    }
}
