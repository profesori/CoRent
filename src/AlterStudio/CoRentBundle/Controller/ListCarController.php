<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ListCarController extends Controller
{
    /**
   * @Security("has_role('ROLE_USER')")
   *
   */
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
            return $this->redirectToRoute('list_makinat', array('location' => $data['location'],
            'dateDebut'=>$data['dateDebut'],'dateFin'=>$data['dateFin']));
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
          5/*limit per page*/
        );

      //  $annonces = $query->getResult();
        return $this->render('corent/list.html.twig', array(
            "pagination"=>$pagination,"form"=>$form->createView()
        ));
    }
}
