<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/15/17
 * Time: 10:05 PM
 */

namespace NB\MainBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use NB\MainBundle\Entity\Route;
use NB\MainBundle\Form\RouteEditType;
use NB\MainBundle\Form\RouteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class RouteController extends Controller {

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException("Ce utilisateur n'est pas autorisé à acceder cette page.");
        }

        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('NBMainBundle:Route')->findAll();



        return$this->render('NBMainBundle:Routes:list.html.twig', [
            'list' => $list
        ]);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $route = new Route();
        $form = $this->get('form.factory')->create(new RouteType(), $route);

        if ($form->handleRequest($request)->isValid()) {

            $photo = $form->get('photo')->getData();

            // Genere un nom unique du fichier avant le stocker
            $photoName = md5(uniqid()).'.'.$photo->guessExtension();

            //Transfer le fichier dans le repertoire ou le logo doit etre stocker
            $photo->move(
                $this->getParameter('logo_directory'),
                $photoName
            );

            $route->setPhoto($photoName);

            $from = $form->get('source')->getData()->getNom();
            $to = $form->get('destination')->getData()->getNom();

            $title = $from."-".$to;

            $route->setTitle($title);
            $route->setCreatedAt(new \datetime);
            $route->setUpdatedAt(new \datetime);
            $em->persist($route);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La route a bien ete enregistrée.');
            return $this->redirect($this->generateUrl('nb_main_route'));

        }

        return$this->render('NBMainBundle:Routes:add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function editAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();

        $route = $em->getRepository('NBMainBundle:Route')->find($id);
        $form = $this->get('form.factory')->create(new RouteEditType(), $route);

        if ($form->handleRequest($request)->isValid()) {
            $route->setUpdatedAt(new \datetime);

            $file = $form->get('photo')->getData();
            if(null === $file){
                $route->setPhoto($route->getPhoto());
            }else{
                $extension = $file->guessClientExtension();
                $photo =  md5(uniqid()).".".$extension;

                if(file_exists($this->getParameter('logo_directory').$route->getPhoto()))
                    $file->move(
                        $this->getParameter('logo_directory'),
                        $photo
                    );

                $route->setPhoto($photo);

            }
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La route a bien ete modifiée.');

            return $this->redirect($this->generateUrl('nb_main_route'));
        }

        return$this->render('NBMainBundle:Routes:edit.html.twig', [
            'form' => $form->createView(),
            'route' => $route
        ]);

    }



}