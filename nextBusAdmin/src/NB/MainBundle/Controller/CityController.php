<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/15/17
 * Time: 3:36 PM
 */

namespace NB\MainBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use NB\MainBundle\Entity\City;
use NB\MainBundle\Form\CityEditType;
use NB\MainBundle\Form\CityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CityController extends Controller {

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException("Ce utilisateur n'est pas autorisé à acceder cette page.");
        }

        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('NBMainBundle:City')->findAll();



        return$this->render('NBMainBundle:City:list.html.twig', [
            'list' => $list
        ]);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $city = new City();
        $form = $this->get('form.factory')->create(new CityType(), $city);

        if ($form->handleRequest($request)->isValid()) {

            $photo = $form->get('photo')->getData();

            // Genere un nom unique du fichier avant le stocker
            $photoName = md5(uniqid()).'.'.$photo->guessExtension();

            //Transfer le fichier dans le repertoire ou le logo doit etre stocker
            $photo->move(
                $this->getParameter('logo_directory'),
                $photoName
            );

            $city->setPhoto($photoName);

            $city->setCreatedAt(new \datetime);
            $city->setUpdatedAt(new \datetime);
            $em->persist($city);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Le bus bien ete enregistrée.');
            return $this->redirect($this->generateUrl('nb_main_city'));

        }

        return$this->render('NBMainBundle:City:add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function editAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();

        $city = $em->getRepository('NBMainBundle:City')->find($id);
        $form = $this->get('form.factory')->create(new CityEditType(), $city);

        if ($form->handleRequest($request)->isValid()) {
            $city->setUpdatedAt(new \datetime);

            $file = $form->get('photo')->getData();
            if(null === $file){
                $city->setPhoto($city->getPhoto());
            }else{
                $extension = $file->guessClientExtension();
                $photo =  md5(uniqid()).".".$extension;

                if(file_exists($this->getParameter('logo_directory').$city->getPhoto()))
                    $file->move(
                        $this->getParameter('logo_directory'),
                        $photo
                    );

                $city->setPhoto($photo);

            }
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La ville a bien ete modifiée.');

            return $this->redirect($this->generateUrl('nb_main_city'));
        }

        return$this->render('NBMainBundle:City:edit.html.twig', [
            'form' => $form->createView(),
            'city' => $city
        ]);

    }

}