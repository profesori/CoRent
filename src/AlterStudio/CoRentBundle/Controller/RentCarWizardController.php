<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RentCarWizardController extends Controller
{
    public function indexAction()
    {
        return $this->render('corent/jep.html.twig', array());
    }
}
