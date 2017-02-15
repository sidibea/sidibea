<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/10/17
 * Time: 6:54 PM
 */

namespace NB\MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller{

    public function indexAction(){

        return $this->render('NBMainBundle::index.html.twig');
    }

}