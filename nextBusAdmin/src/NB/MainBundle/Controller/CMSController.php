<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/16/17
 * Time: 6:11 PM
 */

namespace NB\MainBundle\Controller;


use NB\MainBundle\Form\BuyTicketType;
use NB\MainBundle\Form\ModifierType;
use NB\MainBundle\Form\PreparerType;
use NB\MainBundle\Form\ReseauInternationalType;
use NB\MainBundle\Form\ReseauNationalType;
use NB\MainBundle\Form\WhyUsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CMSController extends Controller{

    public function nationalAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $cms = $em->getRepository('NBMainBundle:CMS')->find(1);

        $form = $this->get('form.factory')->create(new ReseauNationalType(), $cms);

        if ($form->handleRequest($request)->isValid()) {

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'vos information ont bien été enregistrées.');

            return $this->redirect($this->generateUrl('nb_main_travel_cms_reseau_national'));
        }



        return $this->render('NBMainBundle:CMS:national.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function internationalAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $cms = $em->getRepository('NBMainBundle:CMS')->find(1);

        $form = $this->get('form.factory')->create(new ReseauInternationalType(), $cms);

        if ($form->handleRequest($request)->isValid()) {

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vos information ont bien été enregistrées.');

            return $this->redirect($this->generateUrl('nb_main_travel_cms_reseau_international'));
        }

        return $this->render('NBMainBundle:CMS:international.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function whyusAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $cms = $em->getRepository('NBMainBundle:CMS')->find(1);

        $form = $this->get('form.factory')->create(new WhyUsType(), $cms);

        if ($form->handleRequest($request)->isValid()) {

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vos information ont bien été enregistrées.');

            return $this->redirect($this->generateUrl('nb_main_travel_cms_why_nextbus'));
        }

        return $this->render('NBMainBundle:CMS:whyus.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function buyAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $cms = $em->getRepository('NBMainBundle:CMS')->find(1);

        $form = $this->get('form.factory')->create(new BuyTicketType(), $cms);

        if ($form->handleRequest($request)->isValid()) {

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vos information ont bien été enregistrées.');

            return $this->redirect($this->generateUrl('nb_main_travel_cms_buy_ticket'));
        }

        return $this->render('NBMainBundle:CMS:buy.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function modifierAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $cms = $em->getRepository('NBMainBundle:CMS')->find(1);

        $form = $this->get('form.factory')->create(new ModifierType(), $cms);

        if ($form->handleRequest($request)->isValid()) {

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vos information ont bien été enregistrées.');

            return $this->redirect($this->generateUrl('nb_main_travel_cms_buy_ticket'));
        }

        return $this->render('NBMainBundle:CMS:modifier.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function preparerAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $cms = $em->getRepository('NBMainBundle:CMS')->find(1);

        $form = $this->get('form.factory')->create(new PreparerType(), $cms);

        if ($form->handleRequest($request)->isValid()) {

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Vos information ont bien été enregistrées.');

            return $this->redirect($this->generateUrl('nb_main_travel_cms_preparer_voyage'));
        }

        return $this->render('NBMainBundle:CMS:preparer.html.twig', [
            'form' => $form->createView()
        ]);
    }

}