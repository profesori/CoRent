<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        //get 4 annonces for front page
        $em = $this->getDoctrine()->getManager();
        $annonceRepository = $em->getRepository('AppBundle:Annonce');
        $query1 =  $annonceRepository->getFrontPageAnnonce();
        //create Form for carlist
        $form = $this->createFormBuilder()
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
            $dateDeb = $data['dateDebut']->format('Y-m-d H:i:s');
            $dateF = $data['dateFin']->format('Y-m-d H:i:s');
            //throw new NotFoundHttpException(print_r($dateDeb));
            //print_r($data);

            return $this->redirectToRoute('list_makinat', array('location' => $data['location']));
        }

        return $this->render('corent/index.html.twig', array("form"=>$form->createView(),"annonces"=>$query1->getResult()));
    }
}
