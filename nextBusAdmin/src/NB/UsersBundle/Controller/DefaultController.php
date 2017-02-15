<?php

namespace NB\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NBUsersBundle:Default:index.html.twig');
    }
}
