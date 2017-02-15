<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/15/17
 * Time: 1:10 AM
 */

namespace NB\MainBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use NB\MainBundle\Entity\Bus;
use NB\MainBundle\Form\BusEditType;
use NB\MainBundle\Form\BusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BusController extends Controller {

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException("Ce utilisateur n'est pas autorisé à acceder cette page.");
        }

        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('NBMainBundle:Bus')->findAll();



        return$this->render('NBMainBundle:Bus:list.html.twig', [
            'list' => $list
        ]);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $bus = new Bus();
        $form = $this->get('form.factory')->create(new BusType(), $bus);

        if ($form->handleRequest($request)->isValid()) {

            $photo = $form->get('photo')->getData();

            // Genere un nom unique du fichier avant le stocker
            $photoName = md5(uniqid()).'.'.$photo->guessExtension();

            //Transfer le fichier dans le repertoire ou le logo doit etre stocker
            $photo->move(
                $this->getParameter('logo_directory'),
                $photoName
            );

            $bus->setPhoto($photoName);

            $bus->setCreatedAt(new \datetime);
            $bus->setUpdatedAt(new \datetime);
            $em->persist($bus);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le bus bien ete enregistrée.');
            return $this->redirect($this->generateUrl('nb_main_bus'));

        }

        return$this->render('NBMainBundle:Bus:add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function editAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();

        $bus = $em->getRepository('NBMainBundle:Bus')->find($id);
        $form = $this->get('form.factory')->create(new BusEditType(), $bus);

        if ($form->handleRequest($request)->isValid()) {
            $bus->setUpdatedAt(new \datetime);

            $file = $form->get('photo')->getData();
            if(null === $file){
                $bus->setPhoto($bus->getPhoto());
            }else{
                $extension = $file->guessClientExtension();
                $photo =  md5(uniqid()).".".$extension;

                if(file_exists($this->getParameter('logo_directory').$bus->getPhoto()))
                    $file->move(
                        $this->getParameter('logo_directory'),
                        $photo
                    );

                $bus->setPhoto($photo);

            }
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le bus a bien ete modifiée.');

            return $this->redirect($this->generateUrl('nb_main_bus'));
        }

        return$this->render('NBMainBundle:Bus:edit.html.twig', [
            'form' => $form->createView(),
            'bus' => $bus
        ]);

    }

}