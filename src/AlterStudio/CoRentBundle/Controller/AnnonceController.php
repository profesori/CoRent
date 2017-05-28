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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Session;

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
        $annonce->setAdresseVoiture($adresse);
        $tabPhotos = [];
        $form   = $this->createForm(AnnonceType::class, $annonce);
        if ($request->isXmlHttpRequest()) {
            $formVoiture = $form->handleRequest($request);
            //get photos if type images
            $dataRequest = $request->request->get('type');

            if ($dataRequest=="images") {
                //handle request
              $files = $request->files->get('input-files');
                $em = $this->getDoctrine()->getManager();
                foreach ($files as $file) {
                    $photo = new UploadedFile($file, $file, "image/png", filesize($file), false, true);
                    $newPhoto = new Photo();
                    $newPhoto->setImageFile($photo);
                    $em->persist($newPhoto);
                    $em->flush();
                    $tabPhotos[] = $newPhoto->getId();
                }
                //add tab to session
                $session = $request->getSession();
                $session->set('photos', $tabPhotos);
                return new Response(json_encode(json_decode("{}")));
            }
        } else {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                //get user connected user
                $user = $this->getUser();
                if (!$user) {
                    throw new AccessDeniedException();
                }
                $annonce->setLoueur($user);
                $em = $this->getDoctrine()->getManager();
                $session = $request->getSession();
                $tabPhotos = $session->get('photos');
                foreach ($tabPhotos as $ph) {
                    $photo =  $this->getDoctrine()
                    ->getRepository('AppBundle:Photo')
                    ->find($ph);
                    $annonce->addPhoto($photo);
                };
                $em->persist($annonce);
                $em->flush();
                $session->remove('photos');
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
        $tabPhotos=[];
        // display photos

        foreach ($photos as $photo) {
            $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
            $path = $helper->asset($photo, 'imageFile');
            $arrayPhoto[] = array("url"=>$path,"id"=> $photo->getId());
        };
        if ($request->isXmlHttpRequest()) {
            $formVoiture = $form->handleRequest($request);
            //get photos if type images
            $dataRequest = $request->request->get('type');
            if ($dataRequest=="images") {
                //handle request
              $files = $request->files->get('input-files');
                $em = $this->getDoctrine()->getManager();
                foreach ($files as $file) {
                    $photo = new UploadedFile($file, $file, 'image/png', filesize($file), false, true);
                    $newPhoto = new Photo();
                    $newPhoto->setImageFile($photo);
                    $em->persist($newPhoto);
                    $em->flush();
                    $tabPhotos[] = $newPhoto->getId();
                }
                //add tab to session
                $session = $request->getSession();
                $session->set('photos', $tabPhotos);
                return new Response(json_encode(json_decode("{}")));
            }
        } else {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                $session = $request->getSession();
                $tabPhotos = $session->get('photos');
                if ($tabPhotos) {
                    foreach ($tabPhotos as $ph) {
                        $photo =  $this->getDoctrine()
                      ->getRepository('AppBundle:Photo')
                      ->find($ph);
                        $annonce->addPhoto($photo);
                    };
                };
                $em->flush();
                $session->remove('photos');
                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                return $this->redirectToRoute('profile');
            }
        }
        return $this->render('corent/edit_vehicle.html.twig', array('form'=>$form->createView(),"photos"=>$arrayPhoto,"annonceID"=>$annonce->getID()));
    }

    /**
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function deletePhotoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isXmlHttpRequest()) {
            //get Data
            $dataRequest = $request->request->get('key');
            $annonceID = $request->request->get('annonceID');
            $photo =  $this->getDoctrine()
            ->getRepository('AppBundle:Photo')
            ->find($dataRequest);
            $annonce = $this->getDoctrine()
            ->getRepository('AppBundle:Annonce')
            ->find($annonceID);

            if ($annonce) {
                $annonce->removePhoto($photo);
                $em->remove($photo);
                $em->flush();
                return new Response(json_encode(json_decode("{}")));
            } else {
                return new Response(json_encode(array("error"=>'Annonce pas trouvé')));
            }
        } else {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
    }
}
