<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UserController extends Controller
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
        return $this->render('corent/profili_tabs/situata.html.twig');
    }
    public function makinatAction()
    {
        return $this->render('corent/profili_tabs/makinat.html.twig');
    }
    public function kerkesatAction()
    {
        return $this->render('corent/profili_tabs/kerkesat.html.twig');
    }
    public function qerateAction()
    {
        return $this->render('corent/profili_tabs/qerate.html.twig');
    }
}
