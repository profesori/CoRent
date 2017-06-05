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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use \DateTime;
use \DateInterval;
use \DatePeriod;

class ListCarController extends Controller
{
    public function indexAction(Request $request)
    {
        //get params
        //$location = $request->query->get('location');
        $dateD = $request->query->get('dateDebut'); // get a $_GET parameter
        $dateF = $request->query->get('dateFin'); // get a $_GET parameter

        //create Form for carlist
        $defaultData = array('dateDebut'=>new \DateTime($dateD),'dateFin'=>new \DateTime($dateF));
        $form = $this->createFormBuilder($defaultData)
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
            $dateDeb = $data['dateDebut']->format('Y-m-d H:i:s');
            $dateF = $data['dateFin']->format('Y-m-d H:i:s');
            if ($dateF>=$dateDeb) {
                return $this->redirectToRoute('list_makinat', array("dateDebut"=>$dateDeb,"dateFin"=>$dateF));
            } else {
                $request->getSession()->getFlashBag()->add('dateError', "Data e nisjes smund te jete me e madhe se data e kthimit");
            }
            //throw new NotFoundHttpException(print_r($data['location']->getVille()));
        }

      //Declare respitory
        $em = $this->getDoctrine()->getManager();
        $annonceRepository = $em->getRepository('AppBundle:Annonce');
        $query = $annonceRepository->getAnnoncesByDate($dateD, $dateF);

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

        //2. check if dates demande are ok
        $curentUser =  $this->getUser();

        //3. create demande form
        if ($curentUser) {
            $email = $curentUser->getEmail();
            $emri = $curentUser->getEmri();
            $mbiemri = $curentUser->getMbiemri();
            $telefoni = $curentUser->getTelefoni();
        }
        $defaultData = array('email' => $email,'emri' => $emri,
        'mbiemri' => $mbiemri,'telefoni' => $telefoni,'annonceID'=>$annonce->getID());
        $form   = $this->createForm(DemandeFormType::class, $defaultData);
        //4.Handle form request
        if ($request->isMethod('POST')) {
            if ($form->handleRequest($request)->isValid()) {
                //get form data
                $data = $form->getData();
                $dateDebut = $data['dateDebut'];
                $dateFin = $data['dateFin'];
                $annonceID = $data['annonceID'];
                $demandeRepository = $em->getRepository('AppBundle:Annonce');
                $days = $dateFin->diff($dateDebut)->format("%a");
            //check if annonce is still free
                $query = $demandeRepository->getAnnoncesByValidDate($annonceID, $dateDebut, $dateFin);
                $isOk = $query->getResult();
                if ($isOk && $days>=0) {
                    //Create new demande Annonce
                    $demande = new DemandesAnnonce();
                    $demande->setDateDebut($dateDebut);
                    $demande->setDateFin($dateFin);
                    $demande->setAnnonce($annonce);
                    $prix = $annonce->getPrixJour() * ($days+1);
                    $demande->setPrix($prix);
                    $var = $this->getParameter('PER_KONFIRMIM_PRONARI');
                    $demande->setStatus($var);
                    $demande->setLocataire($curentUser);
                    $em->persist($demande);
                    $em->flush();
                } else {
                    $request->getSession()->getFlashBag()->add('demande_notice', "Makina nuk eshte e disponueshme per keto data, kerkoni nje tjeter");
                }
            } else {
                //$error = $form->getErrors();
                $request->getSession()->getFlashBag()->add('demande_notice', "Ka nje problem me kerkesen tuaj, provojeni perseri");
            }
        }
        $demandeRepository = $em->getRepository('AppBundle:DemandesAnnonce');
        $query = $demandeRepository->getDemandeByUserAndAnnonce($curentUser, $annonce);
        $demande = $query->getResult();
        return $this->render('corent/annonce_detail.html.twig',
        array("annonce"=>$annonce,"photos"=>$photos,"demande"=>$demande,"form"=>$form->createView()));
    }

    private function getAllFormErrorMessages($form)
    {
        $retval = array();
        if ($form->getErrors()) {
            foreach ($form->getErrors() as $error) {
                $retval[] = $error->getMessage();
            }
        }

        return $retval;
    }
}
