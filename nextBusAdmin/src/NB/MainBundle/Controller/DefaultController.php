<?php

namespace NB\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NBMainBundle:Default:index.html.twig');
    }
}
