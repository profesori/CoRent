<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Form\DemandeFormType;

class ListCarController extends Controller
{
    public function indexAction(Request $request)
    {
        //get params
        $location = $request->query->get('location');
        $dateD = $request->query->get('dateDebut'); // get a $_GET parameter
        $dateF = $request->query->get('dateFin'); // get a $_GET parameter

        if (null === $location) {
            throw new NotFoundHttpException("Veuillez choisir un lieux");
        }
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
        $defaultData = array('email' => $curentUser->getEmail());
        $form   = $this->createForm(DemandeFormType::class, $defaultData);


        return $this->render('corent/annonce_detail.html.twig',
        array("annonce"=>$annonce,"photos"=>$photos,"demande"=>$demande,"form"=>$form->createView()));
    }

    public function demandeAction(Request $request)
    {
        return $this->render('corent/annonce_detail.html.twig', array("annonce"=>$annonce,"photos"=>$photos,"demande"=>$demandes));
    }
}
