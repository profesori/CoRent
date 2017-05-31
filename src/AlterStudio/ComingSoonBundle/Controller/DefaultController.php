<?php

namespace AlterStudio\ComingSoonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AlterStudioComingSoonBundle:Default:index.html.twig');
    }
}
