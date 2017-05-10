<?php

namespace AlterStudio\CoRentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListCarController extends Controller
{
    public function indexAction()
    {
        return $this->render('corent/list.html.twig', array(
            // ...
        ));
    }
}
