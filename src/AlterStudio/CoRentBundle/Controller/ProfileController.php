<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ProfileController extends Controller
{
    /**
   * @Security("has_role('ROLE_USER')")
   */
    public function indexAction()
    {
        return $this->render('corent/profile.html.twig', array(
            // ...
        ));
    }
    public function situataAction()
    {
        $curentUser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $reservationRepository = $em->getRepository('AppBundle:Reservation');
        $query1 =  $reservationRepository->getReservationsForLoueur($curentUser);
        $query2 = $reservationRepository->getReservationsForLocataire($curentUser);
        $queryResults1 = $query1->getResult();
        $queryResults2 = $query2->getResult();
        //number of reservations for Loueur
        $reservations=0;
        //total money earned for Loueur
        $totalMoney = 0;
        foreach ($queryResults1 as $qu) {
            $totalMoney+= $qu->prix;
            $reservations+=1;
        }
        //////////////////
        $reservationForLocataire = 0;
        $totalMoneyForLocataire = 0;
        foreach ($queryResults2 as $qu2) {
            $totalMoneyForLocataire+= $qu2->prix;
            $reservationForLocataire+=1;
        }
        return $this->render('corent/profili_tabs/situata.html.twig',
        array("reservations"=>$reservations,"earnings"=>$totalMoney,"spendings"=>$totalMoneyForLocataire,"rents"=>$reservationForLocataire
        ));
    }
    /**
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function makinatAction()
    {
        $curentUser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $annoncesRepository = $em->getRepository('AppBundle:Annonce');
        $query =  $annoncesRepository->getAnnoncesByUser($curentUser);
        $queryResults = $query->getResult();
        //var_dump($queryResults);
        return $this->render('corent/profili_tabs/makinat.html.twig', array('annonces'=>$queryResults));
    }
    public function kerkesatAction()
    {
        $curentUser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $demandeRepository = $em->getRepository('AppBundle:DemandesAnnonce');
        $query = $demandeRepository->getDemandesAnnonceByLoueur($curentUser);
        $results=$query->getResult();
        //var_dump($results[0]);
        //die;
        return $this->render('corent/profili_tabs/kerkesat.html.twig', array("demandes"=>$results));
    }
    public function qerateAction()
    {
        $curentUser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $demandeRepository = $em->getRepository('AppBundle:DemandesAnnonce');
        $query = $demandeRepository->getDemandesAnnonceByLocataire($curentUser);
        $results=$query->getResult();
        return $this->render('corent/profili_tabs/qerate.html.twig', array("demandes"=>$results));
    }
    
    public function infoAction()
    {
        return $this->render('corent/profili_tabs/info.html.twig');
    }
}
