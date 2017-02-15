<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/26/17
 * Time: 11:47 AM
 */

namespace NB\MainBundle\Controller;


use NB\MainBundle\Form\ContactType;
use NB\MainBundle\Form\SocialType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConfigController extends Controller{

    public function contactAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $cms = $em->getRepository('NBMainBundle:Contact')->find(1);

        $form = $this->get('form.factory')->create(new ContactType(), $cms);

        if ($form->handleRequest($request)->isValid()) {

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vos information ont bien été enregistrées.');

            return $this->redirect($this->generateUrl('nb_main_config_contact'));

        }

        return $this->render('NBMainBundle:Config:contact.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function socialAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $cms = $em->getRepository('NBMainBundle:Social')->find(1);

        $form = $this->get('form.factory')->create(new SocialType(), $cms);

        if ($form->handleRequest($request)->isValid()) {

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vos information ont bien été enregistrées.');

            return $this->redirect($this->generateUrl('nb_main_config_reseau_social'));

        }

        return $this->render('NBMainBundle:Config:social.html.twig', [
            'form' => $form->createView()
        ]);

    }

}