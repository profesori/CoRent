<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Form\DemandeFormType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\DemandesAnnonce;
use \DateTime;
use \DateInterval;
use \DatePeriod;

class ListCarController extends Controller
{
    public function indexAction(Request $request)
    {
        //get params
        $location = $request->query->get('location');
        $dateD = $request->query->get('dateDebut'); // get a $_GET parameter
        $dateF = $request->query->get('dateFin'); // get a $_GET parameter

        //create Form for carlist
        $defaultData = array('location' => $location,'dateDebut'=>new \DateTime($dateD),'dateFin'=>new \DateTime($dateF));
        $form = $this->createFormBuilder($defaultData)
        ->add('location', TextType::class,
        array('constraints' => array(
                 new NotBlank(),
                 new Length(array('min' => 3)),
             )))
             ->add('dateDebut', DateType::class, array(
               'html5'=>false,
               'widget' => 'single_text',
             ))
             ->add('dateFin', DateType::class, array(
               'html5'=>false,
               'widget' => 'single_text',
             ))
        ->add('send', SubmitType::class)
        ->getForm();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $data = $form->getData();
            //throw new NotFoundHttpException(print_r($data));
            return $this->redirectToRoute('list_makinat', array('location' => $data['location']));
        }

      //Declare respitory
        $em = $this->getDoctrine()->getManager();
        $annonceRepository = $em->getRepository('AppBundle:Annonce');
        $query = $annonceRepository->getAnnoncesByQuery($location, $dateD, $dateF);

        //Paginator
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
          $query, /* query NOT result */
          $request->query->getInt('page', 1)/*page number*/,
          3/*limit per page*/
        );

      //  $annonces = $query->getResult();
        return $this->render('corent/list.html.twig', array(
            "pagination"=>$pagination,"form"=>$form->createView()
        ));
    }

    public function viewAction(Request $request, $id)
    {
        //1. get annonce en cours and photos
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('AppBundle:Annonce')->find($id);
        if (null === $annonce) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        $photos = $annonce->getPhotos();
        $arrayPhoto = "";
        $tabPhotos=[];
        foreach ($photos as $photo) {
            $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
            $path = $helper->asset($photo, 'imageFile');
            $arrayPhoto[] = array("url"=>$path,"id"=> $photo->getId());
        };
        //2. check if demande from user
        $curentUser = $this->getUser();
        $demandeRepository = $em->getRepository('AppBundle:DemandesAnnonce');
        $query = $demandeRepository->getDemandeByUserAndAnnonce($curentUser, $annonce);
        $demande = $query->getResult();

        //3. get demande Form
        if ($curentUser) {
            $email = $curentUser->getEmail();
        } else {
            $email = "";
        }
        $defaultData = array('email' => $email,'annonceID'=>$annonce->getID());
        $form   = $this->createForm(DemandeFormType::class, $defaultData);


        return $this->render('corent/annonce_detail.html.twig',
        array("annonce"=>$annonce,"photos"=>$photos,"demande"=>$demande,"form"=>$form->createView()));
    }


    public function demandeAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            //check if user authentificated
            $securityContext = $this->container->get('security.authorization_checker');
            if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                // authenticated REMEMBERED, FULLY will imply REMEMBERED (NON anonymous)
            $em = $this->getDoctrine()->getManager();
                $data = $request->request->get('appbundle_demmande');
                $dateDebut = $data['dateDebut'];
                $dateFin = $data['dateFin'];
                $emri = $data['emri'];
                $mbiemri = $data['mbiemri'];
                $email = $data['email'];
                $annonceID = $data['annonceID'];

                $error = "";

                if ($annonceID<0) {
                    $error = "L'annonce n'est pas correcte!";
                    $array = $reponse = array("status"=>"BAD","error"=>$error);
                    $response = new Response(json_encode($array));
                    $response->headers->set('Content-Type', 'application/json');
                    return $response;
                } else {
                    $annonce = $em->getRepository('AppBundle:Annonce')->find($annonceID);
                    if (null === $annonce) {
                        $error = "L'annonce n'est pas correcte!";
                        $array = $reponse = array("status"=>"BAD","error"=>$error);
                        $response = new Response(json_encode($array));
                        $response->headers->set('Content-Type', 'application/json');
                        return $response;
                    }
                }

            //TODO : ADD VAlidation for inputs

            $demandeRepository = $em->getRepository('AppBundle:Annonce');
            //check if annonce is Free
            $query = $demandeRepository->getAnnoncesByValidDate($annonceID, $dateDebut, $dateFin);
                $isOk = $query->getResult();
                $curentUser = $this->getUser();
                if ($isOk) {
                    //Create new demande Annonce
              $demande = new DemandesAnnonce();
                    $demande->setDateDebut(new DateTime($dateDebut));
                    $demande->setDateFin(new DateTime($dateFin));
                    $demande->setAnnonce($annonce);
                    $var = $this->getParameter('PER_KONFIRMIM_PRONARI');
                    $demande->setStatus($var);
                    $demande->setLocataire($curentUser);
                    $em->persist($demande);
                    $em->flush();

                    $array = array("annonce"=>$annonceID,"status"=>"OK");
                    $response = new Response(json_encode($array));
                    $response->headers->set('Content-Type', 'application/json');
                    return $response;
                } else {
                    //Anononce is not Free
                    $array = array("annonce"=>$annonceID,"status"=>"BAD");
                    $response = new Response(json_encode($array));
                    $response->headers->set('Content-Type', 'application/json');
                    return $response;
                };
            } else {
                $array = array("status"=>"BAD");
                $response = new Response(json_encode($array), 401);
                $response->headers->set('Content-Type', 'application/json');
                return $response;
            }
        } else {
            $reponse = array("annonce"=>$annonceID,"status"=>"BAD");
            return new Response(json_encode($reponse));
        }
    }
}
