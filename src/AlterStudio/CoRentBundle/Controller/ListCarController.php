<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

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
        $dateD = $request->query->get('date-debut'); // get a $_GET parameter
      $dateF = $request->query->get('date-fin'); // get a $_GET parameter

      //Declare respitory
        $em = $this->getDoctrine()->getManager();
        $annonceRepository = $em->getRepository('AppBundle:Annonce');
        $qb = $annonceRepository->createQueryBuilder('ann');
        $query = $qb->join('ann.adresseVoiture', 'adr')
              ->join('adr.ville', 'vi', 'WITH', $qb->expr()->eq('vi.ville', '?1'))
              ->addSelect('adr')
              ->join('ann.calendrier', 'ca')
              ->where($qb->expr()->between('ca.dateStatus', '?2', '?3'))
              ->addSelect('ca')
              ->setParameter(1, $location)
              ->setParameter(2, $dateD)
              ->setParameter(3, $dateD)
              ->getQuery();


        $annonces = $query->getResult();

        return $this->render('corent/list.html.twig', array(
            "annonces"=>$annonces
        ));
    }
}
