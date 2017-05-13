<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ListCarController extends Controller
{
    /**
   * @Security("has_role('ROLE_USER')")
   */
    public function indexAction()
    {
        return $this->render('corent/list.html.twig', array(
            // ...
        ));
    }
}
