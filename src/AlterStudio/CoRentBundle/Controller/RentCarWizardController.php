<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Form\VoiturePriceType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Voiture;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

class RentCarWizardController extends Controller
{
    public function indexAction(Request $request)
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoiturePriceType::class, $voiture, array(
            'action' => $this->generateUrl('alter_studio_co_rent_rent')
          ));
        if ($request->isXmlHttpRequest()) {
            $formVoiture = $form->handleRequest($request);
        }

        return $this->render('corent/jep.html.twig', array(
            'form' => $form->createView()
          ));
    }


    public function getPriceAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            //CheckPrice for modele
            //throw new NotFoundHttpException(print_r($request));
            if ($request->request) {
                $dataModel = $request->request->get('modele');
                $em = $this->getDoctrine()->getManager();
                $modeleVoitureRepository = $em->getRepository('AppBundle:ModeleVoiture');
                $query = $modeleVoitureRepository->getPriceByModel($dataModel);
                $results = $query->getArrayResult();
                $reponse = new JsonResponse($results);
                $reponse->headers->set('Content-Type', 'application/json');
                return $reponse;
            } else {
                return new JsonResponse('null');
            }
        } else {
            throw new NotFoundHttpException("La page n'existe pas");
        }
    }
}
