<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/16/17
 * Time: 10:32 AM
 */

namespace NB\MainBundle\Controller;


use NB\MainBundle\Entity\Travel;
use NB\MainBundle\Form\TravelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TravelController extends Controller{

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException("Ce utilisateur n'est pas autorisé à acceder cette page.");
        }

        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('NBMainBundle:Travel')->findAll();



        return$this->render('NBMainBundle:Travel:list.html.twig', [
            'list' => $list
        ]);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $travel = new Travel();
        $form = $this->get('form.factory')->create(new TravelType(), $travel);

        if ($form->handleRequest($request)->isValid()) {
            $travel->setCreatedAt(new \datetime);
            $travel->setUpdatedAt(new \datetime);
            $em->persist($travel);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le bus bien ete enregistrée.');
            return $this->redirect($this->generateUrl('nb_main_travel'));
        }

        return$this->render('NBMainBundle:Travel:add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();

        $travel =$em->getRepository('NBMainBundle:Travel')->find($id);
        $form = $this->get('form.factory')->create(new TravelType(), $travel);

        if ($form->handleRequest($request)->isValid()) {

            $travel->setUpdatedAt(new \datetime);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le bus bien ete enregistrée.');
            return $this->redirect($this->generateUrl('nb_main_travel'));

        }

        return$this->render('NBMainBundle:Travel:add.html.twig', [
            'form' => $form->createView()
        ]);

    }

}