<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/27/17
 * Time: 2:35 PM
 */

namespace NB\MainBundle\Controller;


use NB\MainBundle\Entity\Promotion;
use NB\MainBundle\Form\PromotionEditType;
use NB\MainBundle\Form\PromotionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PromoController extends Controller {

    public function listAction(){

        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('NBMainBundle:Promotion')->findAll();

        return $this->render('NBMainBundle:Promo:list.html.twig',[
            'list' => $list
        ]);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $promo = new Promotion();

        $form = $this->get('form.factory')->create(new PromotionType(), $promo);

        if($form->handleRequest($request)->isValid()){

            $photo = $form->get('photo')->getData();

            // Genere un nom unique du fichier avant le stocker
            $photoName = md5(uniqid()).'.'.$photo->guessExtension();

            //Transfer le fichier dans le repertoire ou le logo doit etre stocker
            $photo->move(
                $this->getParameter('photo_directory'),
                $photoName
            );

            $promo->setPhoto($photoName);

            $promo->setCreatedAt(new \datetime);
            $promo->setUpdatedAt(new \datetime);
            $em->persist($promo);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La promotion a bien ete enregistrée.');
            return $this->redirect($this->generateUrl('nb_main_promotion'));
        }

        return $this->render('NBMainBundle:Promo:add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();

        $promo = $em->getRepository('NBMainBundle:Promotion')->find($id);
        $form = $this->get('form.factory')->create(new PromotionEditType(), $promo);

        if ($form->handleRequest($request)->isValid()) {
            $promo->setUpdatedAt(new \datetime);

            $file = $form->get('photo')->getData();
            if(null === $file){
                $promo->setPhoto($promo->getPhoto());
            }else{
                $extension = $file->guessClientExtension();
                $photo =  md5(uniqid()).".".$extension;

                if(file_exists($this->getParameter('photo_directory').$promo->getPhoto()))
                    $file->move(
                        $this->getParameter('photo_directory'),
                        $photo
                    );
                $promo->setPhoto($photo);
            }
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La route a bien ete modifiée.');

            return $this->redirect($this->generateUrl('nb_main_promotion'));
        }

        return$this->render('NBMainBundle:Promo:edit.html.twig', [
            'form' => $form->createView(),
            'promo' => $promo
        ]);

    }

    



}