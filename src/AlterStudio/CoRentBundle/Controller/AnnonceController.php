<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Form\AnnonceType;
use AppBundle\Form\VoitureType;
use AppBundle\Entity\Annonce;
use AppBundle\Entity\Voiture;
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
        $voiture = new Voiture();
        $form   = $this->createForm(AnnonceType::class, $annonce);
        $form2 = $this->createForm(VoitureType::class, $voiture, array(
            'action' => $this->generateUrl('add_annonce')
          ));

        if ($request->isXmlHttpRequest()) {
            $formVoiture = $form2->handleRequest($request);
        } else {
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
                return $this->redirectToRoute('profile');
            }
        }
        return $this->render('corent/create_vehicle.html.twig', array(
          'form' => $form->createView(),'form2' => $form2->createView()
        ));
    }
    
    public function detailAction()
    {
        return $this->render('corent/annonce_detail.html.twig');
    }
}
