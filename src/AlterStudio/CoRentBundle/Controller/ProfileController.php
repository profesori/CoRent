<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Form\UserType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use \DateTime;
use \DateInterval;
use \DatePeriod;
use AppBundle\Entity\Reservation;

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
            $totalMoney+= $qu->getPrix();
            $reservations+=1;
        }
        //////////////////
        $reservationForLocataire = 0;
        $totalMoneyForLocataire = 0;
        foreach ($queryResults2 as $qu2) {
            $totalMoneyForLocataire+= $qu2->getPrix();
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
        return $this->render('corent/list_kerkesa.html.twig', array("demandes"=>$results));
    }

    public function refuzoAction(Request $request)
    {
    }

    /**
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function accepteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $curentUser = $this->getUser();

        if ($id>0) {
            //getDemande
                $demande = $em->getRepository('AppBundle:DemandesAnnonce')->find($id);
            if (null === $demande) {
                throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
            }
                    //set status demande =2
                $var = $this->getParameter('KONFIRMUAR');
            $demande->setStatus($var);
                    //set calendrier annonce is free=false
            $annonce = $demande->getAnnonce();
            $start = $demande->getDateDebut();
            $end = $demande->getDateFin();
            $end_loop = $end;
            date_add($end_loop, date_interval_create_from_date_string('1 day'));

            $interval = DateInterval::createFromDateString('1 day');
            $days = new DatePeriod($start, $interval, $end_loop);
            $int= $start->diff($end);
            $diff = $int->format('%a');

            $calendrierRepository = $em->getRepository('AppBundle:Calendrier');

            if ($diff==0) {
                $query = $calendrierRepository->getCalendrierByAnnonceAndData($annonce, $start);
                $calendrier = $query->getSingleResult();
                $calendrier->setIsFree(false);
            } else {
                foreach ($days as $day) {

                    //die;
                    $query = $calendrierRepository->getCalendrierByAnnonceAndData($annonce, $day);
                    $calendrier = $query->getSingleResult();
                    $calendrier->setIsFree(false);
                }
            }
      
                    //Create Reservation
            $reservation = new Reservation();
            $reservation->setDemandeAnnonce($demande);
            $reservation->setDateDebut($start);
            $reservation->setDateFin($end);
            $reservation->setPrix($demande->getPrix());
            $reservation->setReduction(0);
            $em->persist($reservation);

                //set status=refused for every other Demande in annonce with same periode
                foreach ($annonce->getDemandes() as $dem) {
                    if ($dem != $demande) {
                        if (
                            ($dem->getDateDebut()>=$start
                            && $dem->getDateDebut()<=$end) ||
                            ($dem->getDateFin()>=$start
                            && $dem->getDateFin()<=$end)
                            ) {
                            $dem->setStatus($this->getParameter('ANULLUAR'));
                        }
                    }
                }
                //flush All
                $em->flush();
            return $this->redirectToRoute('list_kerkesat');
        }
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

    /**
    * @Security("has_role('ROLE_USER')")
    */
    public function infoAction(Request $request)
    {
        $user = $this->getUser();
        //var_dump($user);

        if (!is_object($user)) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

      /** @var $dispatcher EventDispatcherInterface */
      $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

      /** @var $formFactory FactoryInterface */
      $formFactory = $this->get('fos_user.profile.form.factory');

        //$form = $formFactory->createForm();
        $form=$this->createForm(UserType::class);
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //check if email is different and exists in db

            /** @var $userManager UserManagerInterface */
          $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_edit');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('corent/profile_edit.html.twig', array(
          'form' => $form->createView(),
      ));
    }
}
