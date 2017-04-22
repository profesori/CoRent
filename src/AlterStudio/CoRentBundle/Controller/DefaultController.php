<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('corent/index.html.twig');
    }
}
